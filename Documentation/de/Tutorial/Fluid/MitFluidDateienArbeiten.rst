=====
Mit Fluid-Dateien arbeiten
=====
Das komplette Templating ist mit Fluid zu erledigen.
Wenn möglich, wird nur auf die Datei Resources/Private/Html/Templates/Default.html zugegriffen.
In dieser Datei wird das momentane Backend Layout abgefragt, das dann über ein Partial angesprochen wird, also z.B.
Resources/Private/Html/Partials/BackendLayouts/1.html

Menüs können über die TypoScript-Library oder über die neuen Fluid-ViewHelper eingefügt werden.