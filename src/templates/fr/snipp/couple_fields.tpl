    <p>
        <label for="in_couple_name">Nom</label>
        <select name="in_couple_sex" id="in_couple_sex">
            <option value="m" {% if in_couple.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if in_couple.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="in_couple_name" id="in_couple_name" value="{{in_couple.name}}" />
        {% if errors.in_couple.name.notblank %}
        <label for="in_couple_name" class="error">
            Vous devez entrer votre Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="in_couple_login_email">Courriel</label>
        <input type="text" name="in_couple_login_email" id="in_couple_login_email" value="{{in_couple.login_email}}" />
        {% if errors.in_couple.login_email.email %}
        <label for="in_couple_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.in_couple.login_email.unique %}
        <label for="in_couple_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="in_couple_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="in_couple_tel1" id="in_couple_tel1" value="{{in_couple.tel1}}" />
    </p>
    <p>
        <label for="in_couple_tel2">Cellulaire</label>
        <input type="text" name="in_couple_tel2" id="in_couple_tel2" value="{{in_couple.tel2}}" />
    </p>
    <p>
        <label for="in_couple_address">Addresse</label>
        <textarea name="in_couple_address" id="in_couple_address" >{{in_couple.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="in_couple_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="in_couple_invite_quotas" id="in_couple_invite_quotas" value="{{in_couple.invite_quotas}}" />
</p>
{% endif %}