{% extends 'organisation_base.tpl' %}

{% block content %}
    <h3> Ajouter des utilisateurs par fichier CSV</h3>
    {% if saved %}
    <p> {{ saved }} invit&eacute;s ajout&eacute;s </p>
    {% endif %}
    {% if invalid_users %}
    <p class="error">
    les invit&eacute;s suivants n'ont pas pu &ecirc;tre ajout&eacute;s:<br/>
    {% for user in invalid_users %}
    {{user.name}} - {{user.login_email}}
    {% if user.errors.login_email.unique %}
    ( email d&eacute;j&agrave; enregistr&eacute; ) 
    {% endif %}
    {% if user.errors.login_email.email %}
    ( email invalide ) 
    {% endif %}
    <br/>
    {% endfor %}
    </p>
    {% endif %}
	<form enctype="multipart/form-data" action="" method="post" >
        <input type="hidden" name="MAX_FILE_SIZE" value="350000" />
		<input type="hidden" name="uploadData" id="uploadData" />
Choisir le fichier: <input name="uploadedfile" id="uploadedfile" type="file" /><br /><br />
   		<p>Que faire de ces personnes ?</p>
   		<p><label for="action_blacklist"><input name="action" value="blacklist" id="action_blacklist" type="radio" /> Les ajouter &agrave; la liste noire</label></p>
		<p><label for="action_invite"><input name="action" value="invite" id="action_invite" type="radio" /> Les inviter</label></p>
		<p class="subform"><label for="VIP"><input name="VIP" id="VIP" type="checkbox" />Comme VIP ?</label></p>
		<p class="subform">Dans le groupe / bus : </p>
        <p> <label for="group">Groupe : </label>{{groups_select|safe}} </p>
        <p> <label for="bus">Bus : </label>{{bus_select|safe}} </p>
        <p>	<input type="submit" name="submit" value="Envoyer" /></p>
</form>
{% endblock %}
