{% extends 'organisation_base.tpl' %}

{% block content %}
    <h3> Add users from CSV file</h3>
    {% if saved %}
    <p> {{ saved }} guests added </p>
    {% endif %}
    {% if invalid_users %}
    <p class="error">
    unnable to add the following guests<br/>
    {% for user in invalid_users %}
    {{user.name}} - {{user.login_email}}
    {% if user.errors.login_email.unique %}
    ( email already registered ) 
    {% endif %}
    {% if user.errors.login_email.email %}
    ( invalid email ) 
    {% endif %}
    <br/>
    {% endfor %}
    </p>
    {% endif %}
	<form enctype="multipart/form-data" action="" method="post" >
        <input type="hidden" name="MAX_FILE_SIZE" value="350000" />
		<input type="hidden" name="uploadData" id="uploadData" />
        Choose a file: <input name="uploadedfile" id="uploadedfile" type="file" /><br /><br />
   		<p>What to do with this pearson?</p>
   		<p><label for="action_blacklist"><input name="action" value="blacklist" id="action_blacklist" type="radio" /> Add the to the black list</label></p>
		<p><label for="action_invite"><input name="action" value="invite" id="action_invite" type="radio" /> Invite them</label></p>
		<p class="subform"><label for="VIP"><input name="VIP" id="VIP" type="checkbox" />As VIP ?</label></p>
		<p class="subform">In the group / bus : </p>
        <p> <label for="group">Group : </label>{{groups_select|safe}} </p>
        <p> <label for="bus">Bus : </label>{{bus_select|safe}} </p>
        <p>	<input type="submit" name="submit" value="Envoyer" /></p>
</form>
{% endblock %}
