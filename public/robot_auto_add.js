/*****/
const Nightmare = require('nightmare')
const nightmare = Nightmare({ show: true })

//var postal_code = process.argv[2];
//var station_id = process.argv[3];
var url = process.argv[2];

nightmare
.viewport(1600, 1200)
.goto(url)
.wait(2000)
.evaluate((nightmare) => {
	var title = document.querySelector('h1.firstHeading').innerHTML;
	var audio = '';
	if(document.querySelector('div#wpaudio_tabs'))
	{
		audio = nightmare.click('div.we_file_first .we_file_info a')
			.wait('[video^=JWPlayerstub]').evaluate(() => {
			    return document.querySelector('[video^=JWPlayerstub]').src;
			})
			.end()
			.then((audio) => { // This will log the Proxy's IP
				return audio;
			});
	}
	console.log('AUDIO = ' + audio);
    
}, this)
.then(function(value){
    console.log(value);
    return nightmare.end();
});
/****/