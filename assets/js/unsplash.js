class unsplashCustom{
	loadRandomUnsplash(){
		const url = 'https://api.unsplash.com/photos/random';
		const data = {
			client_id:'2d9baeab7a0520b0e68d6ef28c5ca33c3803f25a65dbee7fc06619e5357dbca8',
			orientation: 'portrait'
		}
		const width = window.innerWidth;
		const height = window.innerHeight;
		const orientation = width > height ? 'landscape' : 'portrait';
		this.orientation = orientation;
		const that = this;
		const storage = JSON.parse(localStorage.getItem('unsplash_'+orientation));
		if(!storage){
			const data = {
				client_id:'2d9baeab7a0520b0e68d6ef28c5ca33c3803f25a65dbee7fc06619e5357dbca8',
				orientation: orientation
			}
			jQuery.ajax({
				url: url,
				data: data,

			}).done(function( data ) {
				const date = new Date();
				const obj = {
					url: data.urls.full,
					color: data.color,
					date: date.getTime()
				}
				localStorage.setItem('unsplash_'+orientation, JSON.stringify(obj));
				that.processUnsplash(obj);
		 	});
		}else{
			this.processUnsplash(storage);
		}
	}
	processUnsplash(obj){
		const diff = 60000 * 60 * 24;
		const time = new Date().getTime();
		if(time - obj.date > diff){
			localStorage.removeItem('unsplash_'+this.orientation);
			this.loadRandomUnsplash();
			return;
		}
		const width = window.innerWidth;
		const height = window.innerHeight;
		const size = this.orientation == 'portrait' ? '&h=' + height : '&w=' + width;
		$('#root').css('background-image', 'url('+obj.url+size+')'); 
		var block = document.querySelector('html');
		block.style.setProperty('--font-color', obj.color);
	}
}
