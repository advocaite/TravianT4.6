/********************************************************************
 * jQuery Dependent Select plug-in									*
 *																	* 
 * @version		2.6													*
 * @copyright	(c) Bau Alexandru 2009 								*
 * @author 		Bau Alexandru										*
 * @email		bau.alexandru@gmail.com								*
 *																	*
 * @depends		jQuery									            *
 * 																	*
 * 																	*
 * Do not delete or modify this header!								*
 *																	* 
 * 																	*
 * Plugin call example:												*
 * 																	*
 * jQuery(function($){												*
 *																	* 
 *		SINGLE CHILD												*
 *		$('#child_id').dependent({							        *
 *			parent:	'parent_id',									*
 *			group:	'common_class',									*
 *          defaultText: '-- select --' // optional                 *
 *		});															*
 *																	* 
 *		MULTIPLE CHILDS												*
 *		$('#child_id').dependent({							        *
 *			parent:	'parent_id'                                     *
 *          defaultText: '-- select --' // optional                 *
 *		});															*
 *																	*
 *	});																*
 *																	*
 ********************************************************************/
	
(function($){	// create closure
	
	/**
	 * Plug-in initialization
	 * @param	object	plug-in options
	 * @return 	object	this
	 */
	$.fn.dependent = function(settings){
		// merge default settings with dynamic settings
		$param = $.extend({}, $.fn.dependent.defaults, settings);
		
		this.each(function(){														// for each element
			$this = $(this);														// current element object
			
			var $parent 	= '#'+$param.parent;
			var $defaultText= $param.defaultText;
			var $suggestText= $param.suggestText; // added
			
			var $child	 	= $this;
			var $child_id 	= $($child).attr('id');
			var $child_cls 	= '.'+$child_id;
			
			if( $param.group != '' ){
				var $group	 	= '.'+$param.group;
			}
			
			var $index 		= 0;
			var $holder  	= 'dpslctholder';
			var $holder_cls	= '.'+$holder;
			
			_createHolder($holder, $holder_cls, $child, $child_id, $child_cls);
			
			// check if parent already has an option selected
			if( $($parent).val() != 0 ) {
				$title = $($parent).find('option:selected').attr('title');
				$($child).find('option[class!='+$title+']').remove();
				$($child).prepend('<option value="">'+ $defaultText +'</option>');
				$(':not(.category0)fieldset').css('display','none'); // added; initially hide all but the very first category (level 0)				
			} else {
				// remove the child's options and add a default option
				$($child).find('option').remove();
				$($child).append('<option value="">'+ $defaultText +'</option>');
			}
			
			_parentChange($parent, $child, $group, $holder_cls, $child_cls, $suggestText);
			
					
		});
			
		return this;
	};
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/*********************************
	 * BEGIN PLUG-IN PRIVATE METHODS *
	 *********************************/
	
	/**
	 * Private function description
	 */
	 
	function _createHolder($holder, $holder_cls, $child, $child_id, $child_cls){
		
		// create a select to hold the options from all this child
		var $is_created = $($holder_cls+' '+$child_id).size();
		
		if( $is_created == 0 ){
			$('body').append('\n\n<select class="'+$holder+' '+$child_id+'" style="display:none">\n</select>\n');
		}
		
		// add options to the holder
		$($child).find('option[value!=]').each(function(){
			
			$value = $(this).attr('value');
			$class = $(this).attr('class');
			$title = $(this).attr('title');
			$text  = $(this).text();
			
			$($holder_cls+$child_cls).append('<option value="'+$value+'" class="'+$class+'" title="'+$title+'">'+$text+'</option>\n');
		});
		
	}
	
	function _parentChange($parent, $child, $group, $holder_cls, $child_cls, $suggestText){
		
		// on change event
		$($parent).bind('change', function(){
			
			// remove all the child's options
			$($child).find('option[value!=]').remove();
			
			$index = $($group).index($(this))
			// set all the selects from the group to the default option
			if( $param.group != ''){
				$($group+':gt('+ $index +')').find('option[value!=]').remove();
			}
			
			$title = $(this).find('option:selected').attr('title');
			// added request answer if category level exceeds 1
			$categorylevel = parseInt($child_cls.substring(9));
			if($categorylevel > 1) {
				$.ajax({
					type: 'GET',
					url: 'index.php?view=answers&action=answer',
					data: 'cid='+$title,
					dataType: 'html',
					success: function(data){			
								$('div.ZeroClipboardOverlay').remove();
								$('div.result').html(data).scrollToAnswer();										
					}
				});	
			}
			// end of addition
			// add options to the child mask from the holder			
			$($holder_cls+$child_cls).find('option[class='+$title+']').each(function(){
																		  
				$value = $(this).attr('value');
				$class = $(this).attr('class');
				$title = $(this).attr('title');
				$text  = $(this).attr('text');
																		  
				$($child).append('<option value="'+$value+'" class="'+$class+'" title="'+$title+'">'+$text+'</option>');
			});
			// added		
			$myoptions = $($child).find('option[value!=]');

			// hide all unused category levels
			/*for(i=$categorylevel;i<11;i++) {
				$('.category'+i).hide();
			} */				
			
			if ($myoptions.length == 0) {
				$($child).hide();
			} else {
				if($categorylevel > 1) {
					$($child).append('<option value="0" class="-" title="-" disabled="disabled">-----------------------------------------------------------</option><option value="0" class="-" title="-">'+ $suggestText +'</option>');
				}
				$('#contentMiddle').hide(); // changed
				$($child).show();				
				$('fieldset.'+$child_cls).not('.'+$holder_cls).css('display','block');				
			}
			// end of addition			
		});	
		
	}
	
	/********************************
	 * /END PLUG-IN PRIVATE METHODS *
	 ********************************/
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/************************************
	 * BEGIN PLUG-IN DEFAULT PARAMETERS *
	 ************************************/
	
	$.fn.dependent.defaults = {	
		parent:			'parent_id',
		defaultText:	'-- select --',
		suggestText:	'An answer for my question was not available' // added
	};
	
	/***********************************
	* /END PLUG-IN DEFAULT PARAMETERS *
	***********************************/
	
})(jQuery);
// end closure