function searchBlogs() {
    var searchTerm = document.getElementById("searchInput").value.toLowerCase();
      var blogTitles = document.querySelectorAll(".blog-title");
  
    for (var i = 0; i < blogTitles.length; i++) {
      var titleText = blogTitles[i].textContent.toLowerCase();
        if (titleText.indexOf(searchTerm) !== -1) {
        // Show the blog post if it matches the search term
        blogTitles[i].style.display = "block";
      } else {
        // Hide the blog post if it doesn't match
        blogTitles[i].style.display = "none";
      }
    }
  }
  