$(function(){
 
var GALLERY = {
  // Set up the container for the gallery (div with id gallery)
  container: ".slider_container",
  // This is the path to the text file containing image filenames
  url: "index/getImages",
  // Set up the delay between reloading the gallery
  delay: 5000,
  // When we load the GALLERY, do this...
  load: function(){
    /* Set up a reference to the GALLERY variable so
    we can use it inside of functions */
    var _gallery = this;
 
    // Begin the Ajax magic...
    $.ajax({
      type: "POST",
      dataType: "json",
      // This references our local .txt file
      url: this.url,
      // BEFORE the request for a new set of images, do this:
      beforeSend: function(){
        // Locate, fade out & remove all imgs inside the referenced div
        $(_gallery.container)
        .find('img')
        .fadeOut('slow', function(){
          $(this).remove();
        });
 
        // Add the 'cool' spinner while the request is processed
        $('<div></div>')
        .attr('id','spinner')
        .hide()
        .appendTo(_gallery.container)
        .fadeIn('slow');
      },
      // If the file is SUCCESSFULLY fetched, do this:
      success: function(data){
        /* Store all the image filenames inside the images variable.
        Because they are separated with a '|', we
        use that inside the split() function */
        var images = data;
        /* Then we run each image through the
        display function (further down). */
        $.each(images, function(){
          _gallery.display(this);
        });
      },
      // Successful fetch or not, do this:
      complete: function(){
        setTimeout(function(){
         // Trigger the load function again, inside the GALLERY
          _gallery.load();
        // Do so every 5000 milliseconds (as we specified earlier)
        }, _gallery.delay);
 
        // Fade out and then remove the 'cool' spinner
        $('#spinner').fadeOut('slow', function(){
          $(this).remove();
        });
      }
    });
  },
  /* This is the function that deals with the
  image filenames from above. */
  display: function(image_url){
    // Put the filename inside the newly created image tag below
    $('<img />')
    .attr('src', image_url)
    .hide()
    // Once all images are loaded, fade them in
    .load(function(){
      $(this).fadeIn();
    })
    // Fade them into the referenced div
    .appendTo(this.container);
  }
}
 
// Initial trigger to begin the automatic process
GALLERY.load();
 
});