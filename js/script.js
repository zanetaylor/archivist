/*
soundManager.setup({
  consoleOnly: true,
  url: "/swf/",
  flashVersion: 9,
  onready: function() {
    // Ready to use; soundManager.createSound() etc. can now be called.
  }
});

$(function(){
	
	$('.soundlist a').click(function(e){
		e.preventDefault();
		
		if (!soundManager.getSoundById('thesound')){
			var url = $(this).attr('href');
			var sound = soundManager.createSound({
				id: 'thesound',
				url: url
			});
			
			sound.play();
				
		} else {
			var sound = soundManager.getSoundById('thesound');
			
			if (sound.url != $(this).attr('href') || !sound.playState){
				sound.stop();
				sound.url = $(this).attr('href');
				sound.play();
			} else {
				sound.stop();
			}
		}
	});
});
*/