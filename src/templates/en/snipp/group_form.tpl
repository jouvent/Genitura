<h3>Group</h3>
<p>
    <label for="group_name">Group Name / Location </label>
    <input type="text" name="group_name" id="group_name" value="{{group.name}}" />
    {% if errors.group.name.notblank %}
    <label for="user_name" class="error">
        You must enter a group name.
    </label>
    {% endif %}
</p>

<h3>Group Chief</h3>

{% include 'snipp/user_fields.tpl' %}
