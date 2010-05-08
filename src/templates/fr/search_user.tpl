{% extends 'organisation_base.tpl' %}

{% block content %}
    <form name="user_filter" id="user_filter" action="" method="get">
        <p>
        <label for="search">Search : </label>
        <input name="search" id="search_" type="text" value="{{search}}"/>
        </p>
        <p>
        {% include 'snipp/group_bus_select.tpl' %}
        </p>
        <p>
        <input type="submit" value="Go" />
        </p>
    </form>
{% include 'snipp/user_list.tpl' %}
{%endblock %}
