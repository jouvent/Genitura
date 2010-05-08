{% extends 'registration_base.tpl' %}

{% block form %}

    <h3>Identifiez vous avec votre code d'Invitation</h3>
    <form action="" method="post" name="registration">
        {% if errors.key %}
        <label for="user_name" class="error">
            Cl&eacute; invalide.
        </label>
        {% endif %}
        <p>
        <label for="refcode">Courriel</label><br/>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/>
        <br/>
        <label for="refcode">Votre Code d'Invitation</label><br/>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/>
        <input type="submit" name="submit" value="M'identifier" /></p>
    </form>
    <h3>Pas de code d'invitation ?<?h3>
    <p>{{page.content}}</p>
    <form action="registration/request" method="post" name="registration">
        {% if errors.key %}
        <label for="user_name" class="error">
            Cl&eacute; invalide.
        </label>
        {% endif %}
        <table>
        <tr><td>
        <label for="refcode">Pr&eacute;nom</label><br/>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/>
        </td><td>
        <label for="refcode">Nom</label><br/>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/>
        </td></tr>
        <tr><td colspan="2">
        <label for="refcode">Courriel</label><br/>
        <input type="text" name="refcode" id="refcode" value="{{refcode}}"/>
        <input type="submit" name="submit" value="File d'attente" />
        </td></tr>
        </table>
    </form>

{% endblock %}
