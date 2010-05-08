{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

<h3>Registration Payment</h3>

{% if nb_tables == 1 %}
<p>a table for two people at $70.00</p>
{% else %}
<p>two tables for two people at $140.00</p>
{% endif %}
{% if have_tables %}
<p>{{tables}} table(s) at ${{table_amount}}</p>
{% endif %}
{% if have_chairs %}
<p>{{chairs}} chair(s) at ${{chair_amount}}</p>
{% endif %}


<p> Your registration for Diner en Blanc does not include the purchase of chairs or tables. If you wish to purchase chairs and tables for the event, please enter your order below and click the recalculate button. </p>
<form name="item_form" action="" method="post">
<p> I would like to add
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
table(s) and
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
chair(s) to my order.

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
			 <input type="hidden" name="item_name_1" value="Registration fees for 2">
			 <input type="hidden" name="amount_1" value="70.00">
			 <input type="hidden" name="quantity_1" value="1">
			 {% else %}
			 <input type="hidden" name="item_name_1" value="Registration fees for 4">
			 <input type="hidden" name="amount_1" value="140.00">
			 <input type="hidden" name="quantity_1" value="1">
			 {% endif %}
			 {{item_array.0|safe}}
			 {{item_array.1|safe}}


<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit"></form>
{% endblock %}
