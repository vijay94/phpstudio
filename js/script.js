var codeMirror;

function makeToast(text, isError = false) {
	if (isError) {
		$("#error").find("p").text(text);
	} else {
		$("#success").find("p").text(text);
	}
	$(".toast").addClass("show");
	setTimeout(function (argument) {
		$(".toast").removeClass("show");
	}, 3000);
}

function createNewfile(target) {
	window.lastSelectedElement = target;
	$("#new-file").modal("show");
}

$( document ).ajaxStart(function() {
  $( ".log" ).text( "Triggered ajaxStart handler." );
});

$( document ).ajaxStop(function() {
  $( ".log" ).text( "Triggered ajaxStart handler." );
});

function ajax(url , method = "get",data, cb ) {
	$.ajax({
		url : url,
		method : method,
		data : data,
		success : function (response) {
			cb(response);
		},
		error :  function (response) {
			cb(response);
		}
	});
}

$("body").on("click", ".pft-file > a" , function(e) {
	var self = $(this);
	var filepath = self.data("file");
	var fileArray = filepath.split("/");
	ajax("ajax/getfilecontent.php", "POST", {"file": filepath}, function (response) {
		if (response.success == 1) {
			$(".current-file").text("Current file :"+fileArray[fileArray.length - 1]);
			// $("#editor").text(response.content);
			codeMirror.getDoc().setValue(response.content);
			$("#run").attr("href",filepath);
			$("#editor").attr("data-file", filepath);
		} else {
			makeToast("Saved", true);
		}
	});
});


$("#save").on("click", function (e) {
	var self = $(this);
	var filePath = $("#editor").data("file");
	var content = codeMirror.getDoc().getValue();
	ajax("ajax/savefilecontent.php", "POST", {"file": filePath, "content" : content}, function (response) {
		if (response.success == 1) {
			makeToast("Saved");
		} else {
			makeToast("Cannot be saved", true);
		}
	});
});

codeMirror = CodeMirror.fromTextArea($("#editor")[0], {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true
      });


if ($("#editor").data("file")) {
	var content = $('<div/>').text($("#editor").data("file-content")).html();
	content = content.replace("&lt;", "<").replace("&gt;", ">")
	codeMirror.getDoc().setValue(content);
}

$.contextMenu({
    selector: '.php-file-tree>.pft-directory',
   	callback: function(key, options) {
   		var currentTarget = $(this);
        switch(key){
        	case "new":
        		createNewfile(currentTarget);
        		break;
        }
    },
    items: {
        "new": {name: "New File"},
    }
});


/*
        "cut": {name: "Cut"},
        "copy": {name: "Copy"},
        "paste": {name: "Paste"},
        "delete": {name: "Delete"},
        "sep1": "---------",
*/

$("body").on("submit","#new-file-form", function (e) {
	e.preventDefault();

	var data = $(this).serializeArray(); // convert form to array
	var project = window.lastSelectedElement;
	data.push({name: "projectName", value: project.data("project")});

	ajax("ajax/createFile.php", "POST", data, function (response) {
		if (response.success == 1) {
			makeToast("Created");
			window.location.reload();
		} else {
			makeToast("Cannot create File", true);
		}
	});
});


$("body").on("submit","#new-project-form", function (e) {
	e.preventDefault();
	
	var data = $(this).serializeArray(); // convert form to array

	ajax("ajax/createProject.php", "POST", data, function (response) {
		if (response.success == 1) {
			makeToast("Created");
			window.location.reload();
		} else {
			makeToast("Cannot create File", true);
		}
	});
});