
<style>
		.main-column{
			display:flex;
			width:100%;
		}
		.column-one{
			width:50%;
		}
	</style>

    <h1>Enquiry from career page </h1>
    <br />
    <div class="main-column" style = "display:block; width:100%;">
      <div class="column-one" style = "display:block; width:100%;">
        <h3>Please, find out the applicant details</h3>
        <b>Full Name:</b> {{ $name }}<br /><br />
        <b>Email:</b> {{ $email }}<br /><br />
        <b>Phone:</b> {{$phone}}<br /><br />
        <b>State:</b>{{config('custom.states')[$state]}}
        <b>Message:</b> {{ $message_details }}<br /><br />

        @if($services != null)
          <div class="column-one" style = "display:block; width:100%;">
           
            <b>Interested Areas:</b><br/>
            @foreach($services as $id => $service)
            {{config('custom.career_areas')[$service]}}<br />
            @endforeach
          </div>
	      @endif
    
      </div>
    </div>

