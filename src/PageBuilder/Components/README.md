# HOW-TO create a new component "Seitenbaukasten" [Xyz]

## Inside WordPress

### Create a new "ACF"

- Name *has to be*: "Seitenbaukasten Komponent: [Xyz]"
- Create any necessary new fields related to your component

### Go to the ACF "Seite mit Seitenbaukasten"

- Select the field "Seintenbaukasten"
- Duplicate an already existing Layout, and update it according to your component
  - WARNING: The "Name" *has to be* exactly your component name, followed by "_fields"
- "Feldtyp" = "Klon", "Felder" = "Alle Felder der Feldgruppe Seitenbaukasten Komponent: [Xyz]"
- Verify that the "Präfix für Feldnamen" is switched ON, with the value "[Xyz]_fields_%field_name%"
  - If necessary, switch off and on again to update the correct value


## Define the Model

### In directory src/PageBuidler/Components/

- Copy an already existing component (based on BaseComponent), and update it according to your component
- Filename will be [Xyz]Component.php

### In directory src/Cards/

- Copy an already existing card (based on BaseCard), and update it according to your card
- Filename will be [Xyz]Card.php


## Define the View

### In directory views/components/

- Copy an already existing file, and update it according to your component and the defined design
- Filename will be [Xyz].php

### In directory views/cards/

- Copy an already existing card, and update it according to your card and the defined design
- Filename will be [Xyz]Card.php
