{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

    {% if errors.user.sex.homosexual_couple %}
    <label for="user_name" class="error">
    Chaque table doit accueillir un homme et une femme.
    </label>
    {% endif %}
    <form action="" method="post" name="registration_userinfo" >
    <p>
        <input type="checkbox" name="friends" id="friends" value="yes" {% if friends %} checked="checked" {% endif %}/><label for="friends">Je veux Inviter une autre table</label>
    </p>
    <h3>Veuillez entrer les information personnelles de la premiere personne a l'autre table</h3>
    <p>
        <label for="friend_1_name">Nom</label>
        <select name="friend_1_sex" id="friend_1_sex">
            <option value="m" {% if friend_1.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_1.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_1_name" id="friend_1_name" value="{{friend_1.name}}" />
        {% if errors.friend_1.couple.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_login_email">Couriel</label>
        <input type="text" name="friend_1_login_email" id="friend_1_login_email" value="{{friend_1.login_email}}" />
        {% if errors.friend_1.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friend_1.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friend_1_tel1" id="friend_1_tel1" value="{{friend_1.tel1}}" />
    </p>
    <p>
        <label for="friend_1_tel2">Cellulaire</label>
        <input type="text" name="friend_1_tel2" id="friend_1_tel2" value="{{friend_1.tel2}}" />
    </p>
    <p>
        <label for="friend_1_address">Addresse</label>
        <textarea name="friend_1_address" id="friend_1_address" >{{friend_1.address}}</textarea>
    </p>

    <h3>Veuillez entrer les information personnelles de la seconde personne a l'autre table</h3>
    <p>
        <label for="friend_2_name">Nom</label>
        <select name="friend_2_sex" id="friend_2_sex">
            <option value="m" {% if friend_2.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_2.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_2_name" id="friend_2_name" value="{{friend_2.name}}" />
        {% if errors.friend_2.couple.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_login_email">Couriel</label>
        <input type="text" name="friend_2_login_email" id="friend_2_login_email" value="{{friend_2.login_email}}" />
        {% if errors.friend_2.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friend_2.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friend_2_tel1" id="friend_2_tel1" value="{{friend_2.tel1}}" />
    </p>
    <p>
        <label for="friend_2_tel2">Cellulaire</label>
        <input type="text" name="friend_2_tel2" id="friend_2_tel2" value="{{friend_2.tel2}}" />
    </p>
    <p>
        <label for="friend_2_address">Addresse</label>
        <textarea name="friend_2_address" id="friend_2_address" >{{friend_2.address}}</textarea>
    </p>

    <p><label><input type="submit" name="submit" value="Envoyer"></label></p>

    </form>
{% endblock %}
