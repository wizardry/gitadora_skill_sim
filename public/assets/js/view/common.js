//globals
var PAGEDATA = {}
$(function(){
	var CommonView = Backbone.View.extend({
		el:'body',
		events:{
			"click .js-navToggle":"spNavToggleFunc"
		},
		initialize:function(){
			this.winHeight = $(window).height();
			console.log(0)
		},
		spNavToggleFunc:function(e){
			console.log('a')
			var isNavCurrent = $('.js-navArea').hasClass('current')
			if(isNavCurrent){
				$('.js-navArea').removeClass('current')
			}else{
				$('.js-navArea').addClass('current')
			}
		}
	})
	var commonView = new CommonView();
})
