jQuery(function(){"use strict";


function initColorpicker(){

	$("#colorpickerDemo").colorpicker(),

	$("#colorpickerDemo1").colorpicker()

}



function initTextEditor(){

	$("#textEditorDemo").summernote({

		height:300})

}

function initRangeSlider(){

	var ids=["#sliderEx1","#sliderEx2","#sliderEx3","#sliderEx4","#sliderEx5","#sliderEx6","#sliderEx7"];

	ids.forEach(function(id){

		$(id).slider()

	})

}

	

function _init(){

	initColorpicker(),

	initTextEditor(),

	initRangeSlider()}_init()



});