$('#myModal').on('show.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var title = button.data('title');
	var imgurl = button.data('imgurl');
	var voteid = button.data('voteid');
	var optionid = button.data("optionid");
	console.log(title, imgurl);
	
	$('#myModalLabel').text(title);
	$('#modalimg').attr("src", imgurl);
	$('#modalvoteid').attr('value', voteid);
	$('#modaloptionid').attr('value', optionid);
});

$(".vote-img").each(function () {
    $(this).css('height', $(this).width());
});
