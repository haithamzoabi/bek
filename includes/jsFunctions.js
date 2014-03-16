$(function(){

$(":text,textarea").each(function(){($(this).addClass('txtbox'));});
$("select").each(function(){
  $(this).css({height:'25px'});
});



fixHeight();
});
if (!String.prototype.format) {
  String.prototype.format = function() {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function(match, number) { 
      return typeof args[number] != 'undefined'
        ? args[number]
        : match
      ;
    });
  };
}
function fixHeight (){

	var mainId = '#mainWarpper';
	var contentId=  '#contentWrapper';
	$(contentId).css({height:'auto'});
	var d = $(document).height();
	var b = $('body').height();
	var g = $(contentId).height();
	var c = (d-b>0)? d-b+g : g ;
	$(contentId).css({height:c+'px'});
}
$(window).resize(fixHeight);


function getURLParameter(name) {
    return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||['',null])[1]);
}

function msgBox(success,data){
	
	var msgBox = $('<div/>', {
		class: 'alertBox',
		title:data.msg,
		text: data.msg,
	});
	if (success===false){
		msgBox.addClass('alertBoxError');
	}
	
	
	return msgBox.delay(4000).fadeOut('slow');

}

function open_uploader(txtinput){
	window.open("uploadimg.php?txtimg="+txtinput,"","width=500,height=500,top=10,left=10");
}
function open_pic(pic){
	window.open("../pics/"+pic,"","width=500,height=500,top=10,left=10");
}

var SLIDER = {

	settings: {
		slideCount: 5,
		slideSpeed: 1500,
		loopCounter: 0,
		delayTime: 4500,		
		slideWidth : 620,
		slideHeight : 320,
		parentContainer: '#slide-cont',
		container: '#slide-cont-inner',
		details:'#slide-details'
	},
	init: function() {
		var parentContainer = this.get('parentContainer');		
		if (  $(parentContainer).is(':visible') ) {
			this.loopCounter = this.get('loopCounter');
			this.getSlideData();
		}
	},
	get: function(property){
		return this.settings[property];
	},
	getSlideData: function(){
		var me = this;
		$.ajax({
			type : 'GET',
			url : LOCALS.domainName +'/includes/response.php',
			data : {
				page : 'slider'
			},
			success : me.onGetSlideDataSuccess,
			error : me.onGetSlideDataFail,
			dataType:'json'
		
		});
	
	},
	onGetSlideDataSuccess: function(data){
		if(data.success){
			var rows = data.data;
			var container = $(SLIDER.get('container'));
			var details = $(SLIDER.get('details'));
			var slideWidth = SLIDER.get('slideWidth');
			var slidesLength  = SLIDER.slidesLength = rows.length;
			container.css('width',slideWidth*slidesLength+'px');
			SLIDER.addPlayIcon();
			if (slidesLength>0){
				for(var i in rows){
					var row = rows[i];
					element = SLIDER.createSlideElement(row , i);					
					container.append(element);
					if (i == 0){
						details.append(row.title+'<br>'+row.description);
						$('.play-icon').data(row);
					}
				}
				if (slidesLength>1){
					SLIDER.setPrevAndNextElements();
					SLIDER.loopCounter++;
					SLIDER.moveSlide();
				}
			}
		}
	},
	onGetSlideDataFail: function(data){
		console.log ('fail',data);
	
	},
	createSlideElement: function(row , index){
		var div =  $('<div></div>');
		var imageSrc = "http://i1.ytimg.com/vi/{0}/hqdefault.jpg".format(row.link);
		var img = $('<img />').attr({
			src : imageSrc,
			width : SLIDER.get('slideWidth')-20,
			height: SLIDER.get('slideHeight')-20,
			border:0
		}).css({ 
			'border':'10px solid #fff',
		});
		div.append(img);
		div.attr({
			'class':'slide-element',
			'id' : 'slide-'+index,
			title:row.title
		});
		div.css({		
			width : SLIDER.get('slideWidth'),
			height: SLIDER.get('slideHeight'),			
		});
		div.data(row);
		return div;
	},
	setPrevAndNextElements: function(){
		var parentContainer = SLIDER.get('parentContainer');
		var prevDiv = $('<div></div>').attr({'class':'slide-prev-btn'});		
		var nextDiv = $('<div></div>').attr({'class':'slide-next-btn'});
		prevDiv.on('click' , SLIDER.onPrevClick );
		nextDiv.on('click' , SLIDER.onNextClick );
		
		$(parentContainer).append(prevDiv , nextDiv );
	},
	addPlayIcon: function(){
		var parentContainer = SLIDER.get('parentContainer');
		var playDiv = $('<div></div>').attr({'class':'play-icon'});
		playDiv.on('click' , SLIDER.onPlayClick);
		$(parentContainer).append(playDiv);
	},
	onPrevClick: function(event){
		SLIDER.loopCounter--;
		if (SLIDER.loopCounter < 0){
				SLIDER.loopCounter = SLIDER.slidesLength-1;
		}
		SLIDER.moveSlide((event)?true:false);
	},
	onNextClick: function(event){		
		SLIDER.loopCounter++;		
		if (SLIDER.loopCounter >= SLIDER.slidesLength){
				SLIDER.loopCounter = 0;
		}
		SLIDER.moveSlide((event)?true:false);
	},
	onPlayClick: function(){
		var playIcon = $('.play-icon');		
		var data = playIcon.data();		
		var link = '{0}video?Category={1}&vid={2}'.format(LOCALS.domainName , data.category, data.id);
		document.location.replace(link);
	},
	moveSlide: function(stop){

		var slideWidth = SLIDER.get('slideWidth');
		var delayTime = SLIDER.get('delayTime');
		var slideSpeed = SLIDER.get('slideSpeed');
		var container = SLIDER.get('container');
		if (stop===true){
			$(container).stop(true,true);
		}else{
			$(container).delay(delayTime);
		}		
		$(container).animate({
			right : '-' + (slideWidth * SLIDER.loopCounter) + 'px'
		}, 
		slideSpeed, 
		function(){
			SLIDER.setRowDetails(SLIDER.loopCounter);
			if (!stop){
				SLIDER.onNextClick();
			}
			
		});
	},
	setRowDetails: function(index){
		var row = $('#slide-'+index);
		var playIcon = $('.play-icon');
		var details = $(this.get('details'));
		var data = row.data();
		playIcon.data(data);
		details.html( data.title+'<br>'+data.description);
	}

};

