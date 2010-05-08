   <p>
        <label for="user_name">Nom</label>
		 {% if user.sex == 'm' %} M. {% endif %}
         {% if user.sex == 'f' %} Mme. {% endif %}
		 {{user.name}}
	</p>
    <p>
        <label for="user_login_email">Courriel</label>
        {{user.login_email}}
    </p>
    <p>
        <label for="user_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="tel1" id="tel1" value="{{user.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cellulaire</label>
        <input type="text" name="tel2" id="tel2" value="{{user.tel2}}" />
    </p>
    <p>
        <label for="user_address">Addresse</label>
        <textarea name="address" id="address" >{{user.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="user_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="invite_quotas" id="invite_quotas" value="{{user.invite_quotas}}" />
</p>
{% endif %}

