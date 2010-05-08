{% extends 'registration_base.tpl' %}

{% block form %}
    <h3>Please entre your contact informations</h3>
    {% include 'snipp/message.tpl' %}

    <form action="" method="post" name="registration_userinfo" >
        {% include 'snipp/user_fields.tpl' %}

            <p><label align="right">Password</label>
                <input type="password" id="password" name="password" size="25"></p>

            <p><label align="right">Confirmation</label>
                <input type="password" id="confirmpassword" name="confirmpassword" size="25"></p>
                {% if errors.user.password.valid %}
                <label for="user_name" class="error">
                Invalid password.
                </label>
                {% endif %}

            <p><label><input type="submit" name="submit" value="Send"></label></p>

    </form>
{% endblock %}
