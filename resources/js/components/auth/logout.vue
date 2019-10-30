<template>
	
</template>

<script type="text/javascript">
	export default {
		mounted()
		{
			
			localStorage.removeItem('token');
			localStorage.removeItem('username');

			Toast.fire({
			  type: 'success',
			  title: 'Logged Out Successfully !'
			});

			this.$router.push({name: '/'})

		}
	}
</script>