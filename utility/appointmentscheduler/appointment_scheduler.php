<?php
	class AppointmentScheduler {
		// url where the AppointmentScheduler folder was installed
	    protected $baseURL;
	    public $earliest_time;
	    public $latest_time;
	
	    public function __construct(){
	        $this->baseURL = (strpos($_SERVER['SERVER_PROTOCOL'], "HTTPS") === false ? "http" : "https")."://".$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
			$this->earliest_time = "00:00";
			$this->latest_time = "23:30";
	    }
	    
	    public function calendar() {
	    	return <<< EOF
			<div class="metro">
				<div class="calendar"></div>
			</div>
EOF;
	    }
	    
	    public function timePicker() {
	    	return <<< EOF
			<div id="time_picker_response">
				<i>◀ Please select a day first</i>
			</div>
EOF;
	    }
	    
	    public function submitURL() {
	    	return str_replace("{baseURL}", $this->baseURL, "{baseURL}/submit.php");
	    }
	    
	    public function firstNameTextBox() {
	    	return '<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name">';
	    }
	    
	    public function lastNameTextBox() {
			return '<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name">';
		}
		
		public function emailTextBox() {
			return '<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">';
		}
		
		public function phoneTextBox() {
			return '<input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">';
		}
		
	    public function notesTextArea() {
		    return '<textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any notes"></textarea>';
	    }
	    
	    public function hiddenFields() {
		    return '<input type="hidden" id="day" name="day" />
					<input type="hidden" id="month" name="month" />
					<input type="hidden" id="year" name="year" />
					<input type="hidden" id="times" name="times" />
					<input type="hidden" id="start" name="start" />
					<input type="hidden" id="end" name="end" />';
	    }
	    
	    public function submitButton($text) {
	    	return '<button id="appointment-submit_button" class="btn btn-success presentation_button text-uppercase" onclick="submit();" disabled="disabled">'.$text.'</button>';
	    }
	    
	    public function submitButtonWithClass($text, $class) {
	    	return '<button id="appointment-submit_button" class="'.$class.'" onclick="submit();" disabled="disabled">'.$text.'</button>';
	    }
	    
	    public function modal() {
		    return '<div id="modal" class="modal">
		    			<table id="modal-title" class="modal-title">
		    				<tr>
		    					<td class="modal-title-td"><b>Success!</b></td>
		    					<td class="modal-title-td" style="width:1%;">
		    						<button class="modal-close-button" onclick="close_modal();">Close</button>
		    					</td>
		    				</tr>
		    			</table>
		    			<div id="modal-text" class="modal-text"></div>
		    		</div>
		    		<div id="tent" class="tent"></div>';
	    }
	    
	    public function styles() {
	    	$styles = <<< EOF
	    		<link href="{baseURL}/css/calendar.css" rel="stylesheet" type="text/css">
				<link href="{baseURL}/css/metro-bootstrap.css" rel="stylesheet" type="text/css">
				<link href="{baseURL}/css/metro-bootstrap-responsive.css" rel="stylesheet" type="text/css">
EOF;
			return str_replace("{baseURL}", $this->baseURL, $styles);
	    }
	    
	    public function scripts() {
	    	$scripts = <<< EOF
				<script src="{baseURL}/js/jquery.widget.min.js"></script>
				<script src="{baseURL}/js/metro.min.js"></script>
				<script>
					var selected_times = [];
					
					var cal = $(".calendar").calendar({
				        multiSelect: false,
				        click: function(d){
				        	var earliest_time = "{earliest_time}";
				        	var latest_time = "{latest_time}";
				        	var backup = $( "#time_picker_response" ).html();
				        	$( "#time_picker_response" ).html( "<i>↺ Loading...</i>" );
				        	$( "#day" ).val(parseInt(d.substr(8, 2)));
				        	$( "#month" ).val(parseInt(d.substr(5, 2)));
				        	$( "#year" ).val(d.substr(0, 4));
				            $.post( "{baseURL}/time_picker.php", { date: d, earliest_time: earliest_time, latest_time: latest_time } )
								.done(function( data ) {
									$( "#time_picker_response" ).html( data );
									unselect_all_times();
								})
								.fail(function() {
									alert( "There was an network error. Please try again." );
									$( "#time_picker_response" ).html( backup );
								});
				        }
				    });
				    
				    function submit() {
				    	var first_name = $("#first_name").val(); 
			    		var last_name = $("#last_name").val(); 
			    		var email = $("#email").val();
			    		var phone = $("#phone").val();
			    		var day = $("#day").val();
			    		var month = $("#month").val();
			    		var year = $("#year").val();
			    		var times = $("#times").val();
			    		var start = $("#start").val();
			    		var end = $("#end").val();
			    		var type = $("#type").val();
			    		var notes = $("#notes").val();
			    		toggle_submit_button(); 
						$("#appointment-submit_button").text("↺ Loading...");
					    $.post("{baseURL}/submit.php", 
					    	{ 
					    		first_name: first_name, 
					    		last_name: last_name, 
					    		email: email,
					    		phone: phone,
					    		day: day,
					    		month: month,
					    		year: year,
					    		times: times,
					    		start: start,
					    		end: end,
					    		type: type,
					    		notes: notes
					    	})
							.done(function( data ) {
								if(data != "ERROR") {
									$("#modal-text").html( data );
									$("#modal").center();
									$("#modal").show();
									$("#tent").show();
									unselect_all_times();
									$("#first_name").val(""); 
						    		$("#last_name").val(""); 
						    		$("#email").val("");
						    		$("#phone").val("");
						    		$("#times").val("");
						    		$("#start").val("");
						    		$("#end").val("");
						    		$("#type").val("");
						    		$("#notes").val("");
								} else {
									alert( "There was an network error. Please try again." + data );
								}
							})
							.fail(function() {
								alert( "There was an network error. Please try again." );
							})
							.always(function() {
								toggle_submit_button(); 
								$("#appointment-submit_button").text("SUBMIT APPOINTMENT");
							});
				    }
				    
				    function select_time(time) {
					    add_time(time);
					    select_time_range();
					    toggle_submit_button();
					    update_times_in_form();
					    //alert(selected_times);
				    }
				    
				    function unselect_time(time) {
					    selected_times.splice($.inArray(time, selected_times),1);
						$("#appointment-time-" + time).attr("onclick", "select_time('" + time + "')");
						$("#appointment-time-" + time).attr("class", "appointment-time available");
						toggle_submit_button();
						update_times_in_form();
				    }
				    
				    function update_times_in_form() {
					    $("#times").val(selected_times.join(","));
					    $("#start").val(selected_times[0]);
					    $("#end").val(selected_times[selected_times.length-1]);
				    }
				    
				    function unselect_all_times() {
				    	var selected_times_copy = selected_times.slice();
					    $.each(selected_times_copy, function( index, value ) {
							unselect_time(value);
						});
				    }
				    
				    function select_time_range() {
					    var first = parseInt(selected_times[0]);
					    var last = parseInt(selected_times[selected_times.length - 1]);
					    var current = first;
					    while(current <= last) {
					    	var time = current.toString();
					    	if(time.length == 2) { time = "00" + time; }
					    	if(time.length == 3) { time = "0" + time; }
					    	if(time.substr(2,1) == "0") { current += 30; } else { current += 70; }
					    	add_time(time);
					    }
				    }
				    
				    function add_time(time) {
				    	if($.inArray(time, selected_times)===-1) {
					    	selected_times.push(time);
							selected_times.sort();
							$("#appointment-time-" + time).attr("onclick", "unselect_time('" + time + "')");
							$("#appointment-time-" + time).attr("class", "appointment-time selected");
					    }
				    }
				    
				    function toggle_submit_button () {
					    if(selected_times.length > 0) {
						    $("#appointment-submit_button").removeAttr("disabled");
					    } else {
						    $("#appointment-submit_button").attr("disabled","disabled");
					    }
				    }
				    
				    jQuery.fn.center = function () {
					    this.css("position","absolute");
					    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
					                                                $(window).scrollTop()) + "px");
					    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
					                                                $(window).scrollLeft()) + "px");
					    return this;
					}
					
					function close_modal() {
						$("#modal").hide();
						$("#tent").hide();
					}
				</script>
EOF;
			$scripts = str_replace("{baseURL}", $this->baseURL, $scripts);
			$scripts = str_replace("{earliest_time}", $this->earliest_time, $scripts);
			$scripts = str_replace("{latest_time}", $this->latest_time, $scripts);
			return $scripts;
	    } 
	    
	}
?>