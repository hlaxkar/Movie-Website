
$('#my-form').submit(function(){
 return false;
});





//  $('#q-submit').click(function(){
//     $.post( 
//     $('#my-form').attr('action'),
//     $('#my-form :input').serializeArray(),
//     function(result){
//         $('#result').html(result);
    
//     }
//     );
//    });

var movid = $('#movid').val();
var title = $('#q-title').val();
var review = $('#q-review').val();
var rate = $('#q-rating').val();
$.ajax({
    type: "POST",
    url: "php/insert-review.php",
    data: { "movid": movid, "title": title, "review": review, "rating": rate },
    cache: true,
    success: function(html){
    alert('success');
    }  
    });
   