//========================================
//empty_form
//========================================
function empty_form(theLang, buttonTitleToUse)
{
	// first make sure the form is showing
	if( document.getElementById('create_group').style.visibility == 'hidden' )
	{
		document.getElementById('create_group').style.visibility = 'visible';
	}

	// use correct label titles
	if(theLang == 'en')
	{
		document.getElementById('group_name_label').innerHTML = 'New Group name: ';
		document.getElementById('group_chief_label').innerHTML = 'Group chief: ';
		document.getElementById('group_button').value = buttonTitleToUse;
	}
	else
	{
		document.getElementById('group_name_label').innerHTML = 'Nom de nouveau groupe: ';
		document.getElementById('group_chief_label').innerHTML = 'Chef de groupe: ';
		document.getElementById('group_button').value = buttonTitleToUse;
	}

	// set the group name to empty
	document.getElementById('group_name').value = '';

	// the name of the group should not be modifiable
	document.getElementById('group_name').readOnly = false;

	$.get("get_group_chiefs.php", function(data){
										   $("#available_chiefs").html("");
										   $("#available_chiefs").append(data);
										 });
}


//========================================
//populate_form
//========================================
function populate_form(theLang, theGroupName, buttonTitleToUse)
{
	// first make sure the form is showing
	if( document.getElementById('create_group').style.visibility == 'hidden' )
	{
		document.getElementById('create_group').style.visibility = 'visible';
	}

	// use correct label titles
	if(theLang == 'en')
	{
		document.getElementById('group_name_label').innerHTML = 'Group name: ';
		document.getElementById('group_chief_label').innerHTML = 'New Group chief: ';
		document.getElementById('group_button').value = buttonTitleToUse;
	}
	else
	{
		document.getElementById('group_name_label').innerHTML = 'Nom de Groupe: ';
		document.getElementById('group_chief_label').innerHTML = 'Nouveau chef de groupe: ';
		document.getElementById('group_button').value = buttonTitleToUse;
	}

	// set the group name
	document.getElementById('group_name').value = theGroupName;

	// the name of the group should not be modifiable
	document.getElementById('group_name').readOnly = true;

	$.get("get_group_chiefs.php", function(data){
										   $("#available_chiefs").html("");
										   $("#available_chiefs").append(data);
										 });
}



//========================================
//validateGroupForm
//========================================
function validateGroupForm(lang)
{
	// check for user data if entered
	if( (document.getElementById('group_name').value == '') ||
			(document.getElementById('available_chiefs').value == '') )
	{
		if(lang == 1)//english
			alert("Please enter values in all fields");
		else
			alert("Veuillez entrer tous les infos");
		return false;
	}
	else
	{
		return true;
	}
}


//========================================
//validateSendEmailForm
//========================================
function validateSendEmailForm(lang)
{
	// check for user data if entered
	if( (document.getElementById('email_subject').value == '') ||
			(document.getElementById('email_body').value == '') )
	{
		if(lang == 1)//english
			alert("Please enter values in all fields");
		else
			alert("Veuillez entrer tous les infos");
		return false;
	}
	else
	{
		return true;
	}
}


