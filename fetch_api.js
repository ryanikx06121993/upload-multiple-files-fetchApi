document.addEventListener(
  "DOMContentLoaded",
  () => {
    // Add input files to array
    var filesToUpload = [];
    // ====================================================================================
    //On Change loop through all file and push to array[]
    // HOW TO CHECK FILES HAS BEEN UPLOADED IN THE FORM USING JAVASCRIT
    document.getElementById("file").addEventListener("change", function () {
      for (var i = 0; i < this.files.length; i++) {
        filesToUpload.push(this.files[i]);
      }
      // HOW TO CHECK FILES HAS BEEN UPLOADED IN THE FORM USING JAVASCRIT
      console.log(filesToUpload);
    });
    // ====================================================================================
    // ACTUAL PROGRAM FOR UPLOADING FILES EXECUTION
    document.getElementById("form").addEventListener("submit", (event) => {
      event.preventDefault();
      //   console.log("form submitted");
      //Store form Data
      var formData = new FormData();
      //Loop through array of file and append form Data
      for (var i = 0; i < filesToUpload.length; i++) {
        const arrayfile = filesToUpload[i];
        formData.append("file[]", arrayfile);
        formData.append("filename", document.getElementById("filename").value);
      }
      //   fetch api programming
      //Fetch Request
      url = document.getElementById("form").action;
      post = document.getElementById("form").method;
      //Fetch Request
      fetch(url, {
        method: post,
        body: formData,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          console.log(data);
          if (data.status == true) {
            alert(data.response);
            document.getElementById("form").reset();
          } else {
            alert(data.response);
          }
        })
        .catch(function (err) {
          // There was an error
          console.warn("Something went wrong.", err);
        });
    });
  },
  true
);
