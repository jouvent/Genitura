{% extends 'base.html' %}

{% block body %}

    <h3>Please enter your Invitation Key</h3>
    <form action="" method="post" name="registration">
        <p>
        <label for="refcode">Your Invitation Key</label>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/><br><br>
        {% if errors.key %}
        <label for="user_name" class="error">
            Invalid key.
        </label>
        {% endif %}
        </p>
        <p><input type="submit" name="submit" value="Activate" /></p>
    </form>
{% endblock %}
