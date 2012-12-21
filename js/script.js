
//soundManager.onready(buildSoundboard);

$(function(){
	soundManager.url = '/swf/';
	soundManager.flashVersion = 9;
	
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