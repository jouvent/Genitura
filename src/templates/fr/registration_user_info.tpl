{% extends 'registration_base.tpl' %}

{% block form %}
    <h3>Veuillez entrer vos information personnelles</h3>
    {% include 'snipp/message.tpl' %}

    <form action="" method="post" name="registration_userinfo" >
        {% include 'snipp/user_fields.tpl' %}

            <p><label align="right">Mot de Passe</label>
                <input type="password" id="password" name="password" size="25"></p>

            <p><label align="right">Confirmation</label>
                <input type="password" id="confirmpassword" name="confirmpassword" size="25"></p>
                {% if errors.user.password.valid %}
                <label for="user_name" class="error">
                Mot de passe invalide.
                </label>
                {% endif %}

            <p><label><input type="submit" name="submit" value="Envoyer"></label></p>

    </form>
{% endblock %}
