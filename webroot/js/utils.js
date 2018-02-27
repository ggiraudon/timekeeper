function addActivity(user_id,client_id,project_id,billable_time,notes,callback)
{

	$.ajax({
		type: "POST",
		url: "/api/activities.json",
		contentType: "application/json",
		data: JSON.stringify({
			"user_id": user_id,
			"client_id": client_id,
			"project_id": project_id,
			"billable_time": billable_time,
			"notes": notes,
			})
		})
		.done(function(data) {
				callback(data);
				})
		.fail(function(data) {
				alert( "error saving activity" );
		});



}

function addTimer(user_id,client_id,project_id,notes,callback)
{

	$.ajax({
		type: "POST",
		url: "/api/user_timers.json",
		contentType: "application/json",
		data: JSON.stringify({
			"user_id": user_id,
			"client_id": client_id,
			"project_id": project_id,
			"description": notes,
			})
		})
		.done(function(data) {
				callback(data);
				})
		.fail(function(data) {
				alert( "error saving timer" );
		});

}



function deleteTimer(timer_id,callback)
{

	$.ajax({
		type: "DELETE",
		url: "/api/user_timers/"+timer_id+".json",
		contentType: "application/json",
		})
		.done(function(data) {
			callback(data);

		})
		.fail(function(data) {
				alert( "error deleting timer" );
		});

}




function pauseTimer(timer_id,timer_value,callback)
{
	$.ajax({
		type: "GET",
		url: "/api/user_timers/"+timer_id+".json",
		contentType: "application/json",
		})
		.done(function(data) {
				if(data.data.paused==0)
				{
					$.ajax({
						type: "PUT",
						url: "/api/user_timers/"+timer_id+".json",
						contentType: "application/json",
						data: JSON.stringify({
								"id": timer_id,
								"add": timer_value,
								"paused": 1
							})
						})
						.done(function(data){
							callback(data);

						})
						.fail(function(){ alert("Error saving timer"); });
					


				}
				})
		.fail(function(data) {
				alert( "error" );
				});


}



function startTimer(timer_id,callback)
{

	$.ajax({
		type: "GET",
		url: "/api/user_timers/"+timer_id+".json",
		contentType: "application/json",
		})
		.done(function(data) {
				if(data.data.paused==1)
				{
					var timer_value=data.data.add;
					$.ajax({
						type: "PUT",
						url: "/api/user_timers/"+timer_id+".json",
						contentType: "application/json",
						data: JSON.stringify({
								"id": timer_id,
								"paused": 0
							})
						})
						.done(function(data){
							callback(data,timer_value);

						})
						.fail(function(){ alert("Error saving timer"); });
					


				}
				})
		.fail(function(data) {
				alert( "error" );
				});




}
