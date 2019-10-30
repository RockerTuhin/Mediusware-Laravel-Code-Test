class Notification {

	success()
	{
		new Noty({
		    type: 'success',
		    layout: 'topRight',
		    text: 'Successfully Done !',
		    timeout: 1000,
		    
		}).show();
	}

	cart_success()
	{
		new Noty({
		    type: 'success',
		    layout: 'topRight',
		    text: 'Product added to cart!',
		    timeout: 1000,
		}).show();
	}

	alert()
	{
		new Noty({
		    type: 'alert',
		    layout: 'topRight',
		    text: 'Are you sure ?',
		    timeout: 1000,
		    
		}).show();
	}

	error()
	{
		new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Something went wrong !',
		    timeout: 1000,
		    
		}).show();
	}

	warning()
	{
		new Noty({
		    type: 'warning',
		    layout: 'topRight',
		    text: 'Oops ! wrong',
		    timeout: 1000,
		    
		}).show();
	}

	image_validation()
	{
		new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Image size have to be less than 1 mb !',
		    timeout: 1000,
		    
		}).show();
	}

	salaryError()
	{
		new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Salary already provided to the employee in that month !',
		    timeout: 1000,
		    
		}).show();
	}
}

export default Notification = new Notification();