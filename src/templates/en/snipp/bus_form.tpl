
<h3>Bus Chief</h3>
    {% include 'snipp/user_fields.tpl' %}


<h3>Bus</h3>
<p>
    <label for="bus_name">Bus Name / Location </label>
    <input type="text" name="bus_name" id="bus_name" value="{{bus.name}}" />
    {% if errors.bus.name.notblank %}
    <label for="user_name" class="error">
        You must enter a name for this Bus.
    </label>
    {% endif %}
</p>

{% if logged.type == 'A' %}

<p>
    <label for="bus_size">Seats available on this Bus</label>
    <input type="text" name="bus_size" id="bus_size" value="{{bus.size}}" />
</p>
{% endif %}

