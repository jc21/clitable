# Table of contents

- [\jc21\CliTable](#class-jc21clitable)
- [\jc21\CliTableManipulator](#class-jc21clitablemanipulator)

<hr /> 

## Class: \jc21\CliTable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$itemName=`'Row'`</strong>, <em>bool</em> <strong>$useColors=true</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>addField(</strong><em>string</em> <strong>$fieldName</strong>, <em>string</em> <strong>$fieldKey</strong>, <em>bool/bool/object</em> <strong>$manipulator=false</strong>, <em>string</em> <strong>$color=`'reset'`</strong>)</strong> : <em>void</em><br /><em>addField</em> |
| public | <strong>display()</strong> : <em>void</em><br /><em>display</em> |
| public | <strong>get()</strong> : <em>string</em><br /><em>get</em> |
| public | <strong>getHeaderColor()</strong> : <em>string</em><br /><em>getHeaderColor</em> |
| public | <strong>getItemName()</strong> : <em>string</em><br /><em>getItemName</em> |
| public | <strong>getShowHeaders()</strong> : <em>bool</em><br /><em>getShowHeaders</em> |
| public | <strong>getTableColor()</strong> : <em>string</em><br /><em>getTableColor</em> |
| public | <strong>getUseColors()</strong> : <em>bool</em><br /><em>getUseColors</em> |
| public | <strong>injectData(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>injectData</em> |
| public | <strong>setChars(</strong><em>array</em> <strong>$chars</strong>)</strong> : <em>void</em><br /><em>setChars</em> |
| public | <strong>setHeaderColor(</strong><em>string</em> <strong>$color</strong>)</strong> : <em>void</em><br /><em>setHeaderColor</em> |
| public | <strong>setItemName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>setItemName</em> |
| public | <strong>setShowHeaders(</strong><em>bool</em> <strong>$bool</strong>)</strong> : <em>void</em><br /><em>setShowHeaders</em> |
| public | <strong>setTableColor(</strong><em>string</em> <strong>$color</strong>)</strong> : <em>void</em><br /><em>setTableColor</em> |
| public | <strong>setUseColors(</strong><em>bool</em> <strong>$bool</strong>)</strong> : <em>void</em><br /><em>setUseColors</em> |
| protected | <strong>defineColors()</strong> : <em>void</em><br /><em>defineColors</em> |
| protected | <strong>getChar(</strong><em>string</em> <strong>$type</strong>, <em>mixed/int</em> <strong>$length=1</strong>)</strong> : <em>string</em><br /><em>getChar</em> |
| protected | <strong>getColorFromName(</strong><em>string</em> <strong>$colorName</strong>)</strong> : <em>string</em><br /><em>getColorFromName</em> |
| protected | <strong>getFormattedRow(</strong><em>array</em> <strong>$rowData</strong>, <em>array</em> <strong>$columnLengths</strong>, <em>bool</em> <strong>$header=false</strong>)</strong> : <em>string</em><br /><em>getFormattedRow</em> |
| protected | <strong>getPluralItemName()</strong> : <em>string</em><br /><em>getPluralItemName</em> |
| protected | <strong>getTableBottom(</strong><em>array</em> <strong>$columnLengths</strong>)</strong> : <em>string</em><br /><em>getTableBottom</em> |
| protected | <strong>getTableSeperator(</strong><em>array</em> <strong>$columnLengths</strong>)</strong> : <em>string</em><br /><em>getTableSeperator</em> |
| protected | <strong>getTableTop(</strong><em>array</em> <strong>$columnLengths</strong>)</strong> : <em>string</em><br /><em>getTableTop</em> |

<hr /> 

## Class: \jc21\CliTableManipulator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>manipulate(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$row=array()</strong>, <em>string</em> <strong>$fieldName=`''`</strong>)</strong> : <em>string</em><br /><em>manipulate This is used by the Table class to manipulate the data passed in and returns the formatted data.</em> |
| protected | <strong>date(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>date Changes 1372132121 to 25-06-2013</em> |
| protected | <strong>datelong(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>datelong Changes 1372132121 to 25th June 2013</em> |
| protected | <strong>datetime(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>datetime Changes 1372132121 to 25th June 2013, 1:48 pm</em> |
| protected | <strong>dollar(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>dollar Changes 12300.23 to $12,300.23</em> |
| protected | <strong>duetime(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>duetime</em> |
| protected | <strong>month(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>month Changes 1372132121 to June</em> |
| protected | <strong>monthyear(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>monthyear Changes 1372132121 to June 2013</em> |
| protected | <strong>nicenumber(</strong><em>int</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>nicenumber</em> |
| protected | <strong>nicetime(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>nicetime Changes 1372132121 to 25th June 2013, 1:48 pm Changes 1372132121 to Today, 1:48 pm Changes 1372132121 to Yesterday, 1:48 pm</em> |
| protected | <strong>percent(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>percent Changes 50.2 to 50%</em> |
| protected | <strong>text(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>text Strips input of any html</em> |
| protected | <strong>time(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>time Changes 1372132121 to 1:48 pm</em> |
| protected | <strong>year(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>year Changes 1372132121 to 2013</em> |
| protected | <strong>yesno(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>yesno Changes 0/false and 1/true to No and Yes respectively</em> |

