function myFunction()	{
	
	//Definisco una variabile contenitore e prendo dall'html l'elemento con id=data
	var cambio = document.getElementById("data");
	//Sostituisco il <td> con un input 
	cambio.innerHTML = '<input type=date name="data">';
	
	//Ripeto per ogni elemento del form
	cambio = document.getElementById("luogo");
	cambio.innerHTML = '<input type=text name="luogo">';
	
	cambio = document.getElementById("descrizione");
	cambio.innerHTML = '<textarea name="descrizione"></textarea>';
	
	cambio = document.getElementById("link");
	cambio.innerHTML = '<input type=text name="link">';
	
	//Prendo l'intero form
	var nuovoform = document.getElementById('modifica');
	//Concateno al form un nuovo tasto di conferma
	nuovoform.innerHTML = nuovoform.innerHTML + '<input type="submit" value="CONFERMA">';
	//Rendo invisibile il vecchio tasto di modifica
	document.getElementById("tasto").style.display = "none";
	
	//Funzione per la toolbar TinyMCE nel campo <textarea>
	tinymce.init({
		  selector: 'textarea',
		  height: 50,
		  menubar: false,
		  plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code'
		  ],
		  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		  content_css: [
		    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    '//www.tinymce.com/css/codepen.min.css']
		});
};
