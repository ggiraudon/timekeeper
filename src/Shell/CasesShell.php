<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Mailer\Email;
/**
 * Cases shell command.
 */
class CasesShell extends Shell
{
 
    private $text_content_pending=0;
    private $text_content="";
    private $html_content_pending=0;
    private $html_content="";
    private $content_pending=0;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Companies');
        $this->loadModel('Tickets');
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    public function getMailCases()
    {
	$companies=$this->Companies->find('all');
	foreach($companies as $company)
	{

		if(!empty($company->imap_server))
		{

			$server = "{".$company->imap_server.":".$company->imap_port.$company->imap_options."}";
			$username = $company->mail_username;
			$password = $company->mail_password;
			Email::configTransport('outbound', [
			    'host' => $company->smtp_server,
			    'port' => $company->smtp_port,
			    'username' => $username,
			    'password' => $password,
			    'className' => 'Smtp',
			    'tls' => true
			]);

			$mbox = imap_open("$server", "$username", "$password") or $this->out(imap_last_error());

			$num = imap_num_msg($mbox);
			if($num > 0)
			{
				for ($msgid=1; $msgid<=$num; $msgid++) 
				{
					//get from, date and subject
					$header = imap_headerinfo($mbox, $msgid);

					$from = $header->from;
					foreach($from as $id=>$object) {
						$fromaddress = $object->mailbox . "@" . $object->host;
						$fromhost = $object->host;
					}
					$this->out($msgid);
					if($fromhost=="google.com"||$fromhost=="googlemail.com")
					{
						$this->out("Skipped because from google");
						imap_delete($mbox, $msgid);
						continue;
					}
					if(strstr($fromaddress,"daemon"))
					{
						$this->out("Skipped because from daemon");
						imap_delete($mbox, $msgid);
						continue;
					}

					$to = $header->to;
					foreach($to as $id=>$object) {
						$tomailbox = $object->mailbox;
						$tohost = $object->host;
						$toaddress = $object->mailbox . "@" . $object->host;
					}

					$subject = $header->subject;
					$date = $header->date;
					//read the body
					$body = imap_body($mbox, $msgid);
					$structure = imap_fetchstructure($mbox,$msgid);
					$this->out($date." - ".$subject);
					//$this->out($body);
					//$this->out(print_r($structure,true));

					$tosplit=explode("+",$tomailbox);
					$ticket=null;
					$is_update=0;
					if(isset($tosplit[1]))
					{
						try{
							$ticket = $this->Tickets->get($tosplit[1]);
							$is_update = 1;
						   }catch(\Cake\Datasource\Exception\RecordNotFoundException $e){
						   }
				

					}
					if(empty($ticket)){
						$ticket = $this->Tickets->newEntity();
						$ticket->company_id=$company->id;
						$ticket->ticket_number=$company->next_ticket_number;
						$ticket->from_email=$fromaddress;
						$ticket->ticket_title=$subject;
						$ticket->status="NEW";
					}
					if($this->Tickets->save($ticket)){


						$this->storeMessagePart($ticket->id,$structure,$mbox,$msgid,$company);
						$this->finalize($ticket->id);
						$company->next_ticket_number++;
						$this->Companies->save($company);

						$message = "Thank you for reaching out to us. \r\nWe have created a tracking ticket for your request.\r\nIf you wish to add any additional details to this request, please reply to this message\r\nWe will reach out to you as soon as possible\r\n";
						$title = '[#'.$ticket->ticket_number.'] RE:'.$ticket->ticket_title;
						$reply_address="$tomailbox+{$ticket->id}@$tohost";

						if($is_update==1)
						{

							$message = "Thank you for the update\r\nWe will reach out to you as soon as possible\r\n";
							$title = '[#'.$ticket->ticket_number.'] UPDATE:'.$ticket->ticket_title;
							$reply_address="$tomailbox@$tohost";

						}

						$email = new Email();
						$email
						    ->transport('outbound')
						    ->emailFormat('text')
						    ->subject($title)
						    ->to($fromaddress)
						    ->from($reply_address)
						    ->replyTo($reply_address)
						    ->send($message);

						$this->out("SENDING {$reply_address} --> $fromaddress");
					}



					$this->out("\n\n");
					
					//delete email
					imap_delete($mbox, $msgid);
				}
			} else {
				//no emails, refresh again in 20 seconds to check for new
				//header('refresh: 20');
				$this->out("No mail");
			}

			//close connection
			imap_expunge($mbox);
			imap_close($mbox);
		}


	}
	$this->out('Done');
    }


    private function finalize($ticket_id)
    {
	if($this->content_pending==1)
	{	
			$ticketNote = $this->Tickets->TicketNotes->newEntity();
			$ticketNote->ticket_id=$ticket_id;
			if($this->html_content_pending==1)
			{
				
				$ticketNote->content=$this->html_content;
				if($this->text_content_pending==1)
					$ticketNote->content_plain=$this->text_content;
			}else{
				if($this->text_content_pending==1)
				{
					$ticketNote->content=$this->text_content;
					$ticketNote->content_plain=$this->text_content;
				}

			}
			$this->Tickets->TicketNotes->save($ticketNote);
	}
	$this->text_content_pending=0;
	$this->text_content="";
	$this->html_content_pending=0;
	$this->html_content="";
	$this->content_pending=0;

    }

    private function storeMessagePart($ticket_id,$part,$mbox,$msgid,$company,$prefix="")
    {
   	switch($part->type)
	{
		case TYPEMULTIPART:
			foreach($part->parts as $idx=>$subpart)
			{
				$p=$idx+1;
				if($prefix!="") $p=$prefix.".".$p;
				$this->storeMessagePart($ticket_id,$subpart,$mbox,$msgid,$company,$p);
			}
			break;
		case TYPETEXT:
		case TYPEMESSAGE: 
			$this->out("Found object of type :".$part->type." at id ".$prefix);
			if($prefix=="") $prefix=1;
			$content=imap_fetchbody($mbox, $msgid, $prefix);
			if($part->encoding==4)
				$content=quoted_printable_decode($content);
			elseif($part->encoding==3)
				$content=base64_decode($content);

			switch($part->subtype)
			{
				case "PLAIN":
					$this->text_content_pending=1;
					$this->text_content=$content;
					$this->content_pending=1;
					break;

				case "HTML":
					$this->html_content_pending=1;
					$this->html_content=$content;
					$this->content_pending=1;
					break;

			}
			break;
		case TYPEAPPLICATION: 
		case TYPEAUDIO: 
		case TYPEIMAGE: 
		case TYPEVIDEO: 
		case TYPEOTHER: 
			$this->out("Found object of type :".$part->type." at id ".$prefix);
			$filename="";
			if($part->ifdparameters==1)
			{
				foreach($part->dparameters as $param)
				{
					if($param->attribute=="FILENAME")
						$filename=$param->value;	

				}
				if($filename!="")
				{
					$content=imap_fetchbody($mbox, $msgid, $prefix);
					if($part->encoding==4)
						$content=quoted_printable_decode($content);
					elseif($part->encoding==3)
						$content=base64_decode($content);

					$ticketAttachment = $this->Tickets->TicketAttachments->newEntity();
					$ticketAttachment->ticket_id=$ticket_id;
					$ticketAttachment->file_contents=$content;
					$ticketAttachment->file_name=$filename;
					$this->Tickets->TicketAttachments->save($ticketAttachment);
				}
			}
			break;
		
		default:
			$this->out("DEFAULT Found object of type :".$part->type);



	}
    }
}
