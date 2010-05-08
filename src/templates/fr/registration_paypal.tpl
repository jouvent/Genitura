{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

<h3>Payement de votre Inscription</h3>

{% if nb_tables == 1 %}
<p>un inscription pour 1 couple a 70.00$</p>
{% else %}
<p>un inscription pour 2 couples a 140.00$</p>
{% endif %}
{% if have_tables %}
<p>{{tables}} table(s) pour {{table_amount}}$</p>
{% endif %}
{% if have_chairs %}
<p>{{chairs}} chaise(s) pour {{chair_amount}}$</p>
{% endif %}


<p> Votre inscription pour Diner en Blanc ne comprend pas l'achat des tables et chaises. Si vous voulez en acheter, svp entrez votre commande en bas. </p>
<form name="item_form" action="" method="post">
<p> Je veux ajouter
<select name="table_select" id="table_select">
<option value="0">0</option>
{% if tables == 1 %}
<option value="1" selected>1</option>
{% else %}
<option value="1">1</option>
{% endif %}
{% if tables == 2 %}
<option value="2" selected>2</option>
{% else %}
<option value="2">2</option>
{% endif %}
</select>
table(s) et
<select name="chair_select" id="chair_select">
<option value="0">0</option>
{% if chairs == 1 %}
<option value="1" selected>1</option>
{% else %}
<option value="1">1</option>
{% endif %}
{% if chairs == 2 %}
<option value="2" selected>2</option>
{% else %}
<option value="2">2</option>
{% endif %}
{% if chairs == 3 %}
<option value="3" selected>3</option>
{% else %}
<option value="3">3</option>
{% endif %}
{% if chairs == 4 %}
<option value="4" selected>4</option>
{% else %}
<option value="4">4</option>
{% endif %}
</select>
chaise(s) &agrave; ma commande.

<input type="button" name="submit" value="Recalculer" onclick="refresh_items(document.item_form.table_select.value, document.item_form.chair_select.value);return false;"></form>
</form>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			 <input type="hidden" name="cmd" value="_cart">
			 <input type="hidden" name="currency_code" value="CAD">
			 <input type="hidden" name="upload" value="1">
			 <input type="hidden" name="business" value="paypal@dinerenblanc.info">
			 <input type="hidden" name="return" value="http://70.25.126.201/registraion/registration_paypal_success">
			 <input type="hidden" name="cancel_return" value="http://70.25.126.201/registration/registration_paypal_fail">
			 {% if nb_tables == 1 %}
			 <input type="hidden" name="item_name_1" value="Frais d'inscription pour un couple">
			 <input type="hidden" name="amount_1" value="70.00">
			 <input type="hidden" name="quantity_1" value="1">
			 {% else %}
			 <input type="hidden" name="item_name_1" value="Frais d'inscription pour deux couples">
			 <input type="hidden" name="amount_1" value="140.00">
			 <input type="hidden" name="quantity_1" value="1">
			 {% endif %}
			 {{item_array.0|safe}}
			 {{item_array.1|safe}}

<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit"></form>
{% endblock %}
