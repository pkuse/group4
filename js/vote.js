
$('#myModal').on('show.bs.modal', function(event){
	var button = $(event.relatedTarget)
	var title = button.data('title')
	var imageurl = button.data('imageurl')

	var modal = $(this)
	modal.find('#myModalLabel').val(title)
	modal.find('#modalimg').setAttriute("src", imageurl)
})
