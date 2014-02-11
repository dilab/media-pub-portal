$(document).ready(function(){
	loadMore();
	
	// toggle video/image upload fields
	updateImgVid();
	$('.group-trigger').change(function(){
		updateImgVid();
	});
});

// loading more function for post index pages
// load-more-div and load-more-btn classes are required
function loadMore() {
	$('.load-more-btn').each(function(index){
		var loadMoreBtn = $(this);
		var obj = $(this);
		var curPage = obj.attr('data-page');
		var categoryId	= obj.attr('data-category');
		var url = obj.attr('href');
		var data = {category_id:categoryId, page:curPage};
		// hide/show loadmore
		$.post(url, data, function(dt){
			if(""!=dt && null!=dt) {
				loadMoreBtn.parents('.load-more-div').eq(0).fadeIn('fast');
			}
		});
		// click to load more
		$(loadMoreBtn).click(function(e){
			e.preventDefault();
			loadMoreBtn.button('loading');
			
			$.post(url, data, function(dt){
				if(""==dt || null==dt) {
					loadMoreBtn.parents('.load-more-div').eq(0).fadeOut('fast');
				} else {
					loadMoreBtn.parents('.load-more-div').eq(0).before(dt).fadeIn('slow');
					data.page = data.page+1;
				}
				loadMoreBtn.button('reset');
			});
		});
	});
}

// toggle video/image upload fields for submit page
function updateImgVid() {
	var value = $('.group-trigger').val();
	if ('image'==value) {
		$('.group-video').parents('.form-group').hide(1);
		$('.group-image').parents('.form-group').show(1);
	} else {
		
		$('.group-video').parents('.form-group').show(1);
		$('.group-image').parents('.form-group').hide(1);
	}
}