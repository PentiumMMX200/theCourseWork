function happybrthd(str) {
    let steps = [];

    steps.push(`%c %c %c ${str} `);
    steps.push(`background: #00416a; line-height: 26px;`);
    steps.push(`background: #00416a; line-height: 26px;`);
    steps.push(`background: #00416a; line-height: 26px; color: #fefefe;`);


    window.console.log.apply(console, steps);
  }

  happybrthd("С днём рождения, Паша!");