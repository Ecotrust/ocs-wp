Quick Bulk Taxonomy Term Creator
==============================

## About

A handy WordPress plugin for batch creation of terms in your preferred hierarchy. Indispensable tool for WordPress developers.

## Getting Started

After installing and activating the plugin, go to Tools -> Quick Term Creator. Please, refer to the Usage section below for usage information and examples.

## Usage

When you go to Tools -> Quick Term Creator, you will find a form with the following fields:

#### Hierarchy Indent Character
Specifies the character (or set of characters) that are used to specify the hierarchy indentation. You can use those characters in your Terms text, prepending one or more terms with one or more of these characters. You can read more about how this field is used in the "Terms" field description below.

#### Taxonomy
Specifies the taxonomy of the terms that you want to bulk create.

#### Terms
Allows you to insert as many titles of terms as you wish. Each term should be on a separate line. You can additionally prepend each term with one or more hierarchy indent characters. For example, if your character is an asterisk - `*`, you can use one asterisk at the beginning of an term to specify that it is a child of the last item without any asterisks. You can use 2 asterisks at the beginning of an term to specify that it is a child of the last item with 1 asterisk, and so on. There is no limit of how deep you can go with your hierarchy. Also, there is no limit of the number of terms that you might want to bulk create. 

## Examples

#### Example 1

The following example will create 5 category terms with the corresponding titles.

* Hierarchy Indent Character: `*`
* Term Type: `Category`
* Terms: 

```
Term 1
Term 2
Term 3
Term 4
Term 5
```

#### Example 2

The following example will create 5 category terms with the corresponding titles and the specified hierarchy (X1, X2 as a child of X, X1a as a child of X1 and X2, X and Y as parents).

* Hierarchy Indent Character: `-`
* Term Type: `Category`
* Terms: 

```
Term X
- Term X1
-- Term X1a
- Term X2
Term Y
```

## Ideas and bug reports

Any bug reports or ideas for new functionality that users would benefit from are welcome. 

If you have an idea for a new feature, or you want to report a bug, feel free to do it in the WordPress Plugin Directory Support tab, or you can do it here at repository. 