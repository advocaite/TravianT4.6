window.Ee = function()
{
	this.preload(Ee.PRELOAD, this.start.bind(this));
	return this;
};

/**
 * Balancing
 */
Ee.Balancing =
{
	units:
	{
		hero:		{party: 0,		health: 100,	offense: Math.floor(65 + Math.random() * 11) / 10,	clickBonus: 0,	hitChance: 50,	speed: 18,	jumpInElement: '#heroImageButton img.heroImage',		picture: '/hero_body.php?uid={uid}&size=profile'.substitute(jQuery('#heroImageButton').down('.heroImage').src.fromQueryString())},
		unit00:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t1 img',		picture: '/js/Game/Logout/Ee/img/t01.gif'},
		unit01:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t2 img',		picture: '/js/Game/Logout/Ee/img/t02.gif'},
		unit02:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t3 img',		picture: '/js/Game/Logout/Ee/img/t03.gif'},
		unit03:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t4 img',		picture: '/js/Game/Logout/Ee/img/t04.gif'},
		unit04:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t5 img',		picture: '/js/Game/Logout/Ee/img/t05.gif'},
		unit05:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t6 img',		picture: '/js/Game/Logout/Ee/img/t06.gif'},
		unit06:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t7 img',		picture: '/js/Game/Logout/Ee/img/t07.gif'},
		unit07:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t8 img',		picture: '/js/Game/Logout/Ee/img/t08.gif'},
		unit08:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t9 img',		picture: '/js/Game/Logout/Ee/img/t09.gif'},
		unit09:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t10 img',	picture: '/js/Game/Logout/Ee/img/t10.gif'},
		unit10:		{party: 1,		health: 100,	offense: 0.5,										clickBonus: 10,	hitChance: 10,	speed: 9,	jumpInElement: '#unitRowAtTown td.uniticon.t11 img',	picture: '/js/Game/Logout/Ee/img/t11.gif'},

		element:	{party: null,	health: 5,		offense: 0,											clickBonus: 0,	hitChance: -1,	speed: 0,	jumpInElement: null,	picture: null}
	},
	parties:
	{
		0: {attackInterface: false},
		1: {attackInterface: true}
	},
	showText:
	{
		startFight: '/js/Game/Logout/Ee/img/fight.png',
		looseFight: '/js/Game/Logout/Ee/img/loose.png',
		winFight: '/js/Game/Logout/Ee/img/win.png'
	},
	fight:
	{
		minAttackRange: 10,
		walkTimeInterval:	{max: 11,		min: 9},
		attackTimeInterval:	{max: 11,		min: 9},
		elementsToFill: 20
	}
};

/**
 * scripts und anderes Zeugs zum laden
 *
 * @var {Array}
 */
Ee.PRELOAD =
[
	{type: 'script', source:	'lib.js'},
	{type: 'script', source:	'Base.js'},
	{type: 'script', source:	'Iterator.js'},
	{type: 'script', source:	'Units.js'},
	{type: 'script', source:	'Units/Elements.js'},
	{type: 'script', source:	'Unit.js'},
	{type: 'script', source:	'Unit/Element.js'},
	{type: 'script', source:	'Fighter.js'},
	{type: 'script', source:	'Fighter/Elements.js'},
	{type: 'script', source:	'Animations.js'},
	{type: 'script', source:	'Animations/JumpIn.js'},
	{type: 'script', source:	'Animations/ShowText.js'},
	{type: 'script', source:	'Animations/ShowHit.js'},
	{type: 'image',	source:	Ee.Balancing.showText.startFight},
	{type: 'image',	source:	Ee.Balancing.showText.looseFight},
	{type: 'image',	source:	Ee.Balancing.showText.winFight},
	{type: 'image',	source:	Ee.Balancing.units.hero.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit00.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit01.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit02.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit03.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit04.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit05.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit06.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit07.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit08.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit09.picture},
	{type: 'image',	source:	Ee.Balancing.units.unit10.picture}
];

/**
 * Basis Z index für alles in EE
 *
 * @var {Number}
 */
Ee.ZINDEX_BASE = 100000;

/**
 * debug
 *
 * @var {Boolean}
 */
Ee.debug = false;

/**
 * log to console
 *
 * @param mixed data
 */
Ee.log = function(data)
{
	if (Ee.debug)
	{
		console.log(data);
	}
};

/**
 * Fighter für die Units
 *
 * @var {Ee.Fighter.Elements}
 */
Ee.prototype.elementsFighter = null;

/**
 * Fighter für die Units
 *
 * @var {Ee.Fighter}
 */
Ee.prototype.fighter = null;

// Prototype
Ee.prototype = Object.create(Object.prototype,
{
	elementsFighter:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (!this._elementsFighter)
			{
				this._elementsFighter = new Ee.Fighter.Elements({}, this);
				this._elementsFighter.addEvent('finish', function()
				{
					Ee.log('Ee is over');
				});
			}

			return this._elementsFighter;
		}
	},

	fighter:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (!this._fighter)
			{
				this._fighter = new Ee.Fighter({}, this);
				this._fighter.addEvent('finish', this.finish.bind(this));
			}

			return this._fighter;
		}
	}
});

/**
 * lädt alle Dinge in der angegeben reihenfolge und führt am ende die Callback Function aus
 *
 * @params {Array} preloads
 * @params {Function} onFinish
 * @returns {Ee}
 */
Ee.prototype.preload = function(preloads, onFinish)
{
	// abdunkeln
	var overlay = (new Overlay(document.body,
	{
		opacity: 0.8,
		duration: 400
	})).open();

	// Container für die Progressbar
	var elementProgressContainer = new Element('div',
	{
		styles:
		{
			position: 'absolute',
			marginLeft: -200,
			left: '50%',
			top: '30%',
			width: 400,
			height: 30,
			border: '1px solid #A00000',
			backgroundColor: 'transparent',
			zIndex: Ee.ZINDEX_BASE
		}
	});

	// Progressbar
	var elementProgress = new Element('div',
	{
		styles:
		{
			position: 'relative',
			width: 0,
			height: '100%',
			border: '0px solid #FF0000',
			backgroundColor: '#70FF00',
			zIndex: Ee.ZINDEX_BASE
		}
	});

	// alles in den DOM Einfügen
	elementProgressContainer.insert(
	{
		bottom: elementProgress
	});
	window.document.body.insert(
	{
		bottom: elementProgressContainer
	});

	var index = 0;

	/**
	 * wenn etwas geladen ist
	 */
	var fnOnFinishLoad = function()
	{
		// zählen wieviel geladen ist
		index++;

		// progress anzeigen
		elementProgress.setStyles(
		{
			width: (index * 100 / preloads.length) + '%'
		});

		// alles geladen? Dann ist schluss und alles ausblenden und starten
		if (index >= preloads.length)
		{
			elementProgressContainer.dispose();
			overlay.close();
			overlay.overlay.hide();
			(onFinish || Travian.emptyFunction)();
		}
	};

	/**
	 * alles laden aber sequentiell
	 *
	 * @param {Number} n
	 */
	var fnLoad = function(n)
	{
		var preloadObject = preloads[n];

		// ein JS Script laden
		if (preloadObject.type == 'script')
		{
			Ee.log('loading script /js/Game/Logout/Ee/' + preloadObject.source);
			Travian.insertScript(
			{
				src: '/js/Game/Logout/Ee/' + preloadObject.source,
				onLoad: function()
				{
					if (n < preloads.length - 1)
					{
						fnLoad(n + 1);
					}
					fnOnFinishLoad();
				}
			});
		}
		// ein Image laden
		if (preloadObject.type == 'image')
		{
			Ee.log('loading image ' + preloadObject.source);
			var element = (new Element('img',
			{
				src: preloadObject.source,
				styles:
				{
					position: 'absolute',
					opacity: 0.1,
					left: 0,
					top: 0
				}
			})).addEvent('load', function()
			{
				if (n < preloads.length - 1)
				{
					fnLoad(n + 1);
				}
				element.dispose();
				fnOnFinishLoad();
			});
			// an body hängen
			window.document.body.insert(
			{
				bottom: element
			});
		}
	};

	fnLoad(0);
	return this;
};

/**
 * startet alles
 *
 * @returns {Ee}
 */
Ee.prototype.start = function()
{
	var self = this;

	Ee.log('starting');

	/**
	 * zeigt die Start Animation "Fight" an
	 */
	var fnShowTextFight = function()
	{
		// Fight beginnt animation
		new Ee.Animations.ShowText(
		{
			image: Ee.Balancing.showText.startFight,
			onComplete: function()
			{
				fnCreateParties();
			}
		});
	};

	/**
	 * erzeugt die Einheiten und Parties
	 */
	var fnCreateParties = function()
	{
		Ee.log('creating parties');

		var counterJumpedIn = 0;

		// Einheiten initialisieren und zuordnen
		Object.each(Ee.Balancing.units, function(balancingUnit, type)
		{
			// hier noch nicht die Elemente erzeugen
			if (type == 'element')
			{
				return;
			}

			// die Party dieser einheit finden
			var units = self.fighter.get(balancingUnit.party);

			// wenn es keine party gibt
			if (units === null)
			{
				// dann wird diese Party angelegt
				units = new Ee.Units(
				{
					id: balancingUnit.party
				});

				// und zu dem Fighter geschoben als neue Party
				self.fighter.add(units);
			}

			Ee.log('creating unit ' + type);

			// entsprechende Unit anlegen
			var unit = new Ee.Unit(
			{
				type: type
			}, units);

			// der Party zuordnen
			units.add(unit);

			// zähl die Einheiten wieviele reinspringen müssen
			counterJumpedIn++;

			// Einheit reinspringen lassen
			new Ee.Animations.JumpIn(
			{
				element: unit.element,
				jumpInFromElement: document.body.down(balancingUnit.jumpInElement),
				onComplete: function()
				{
					// zählt wieder runter der reingesprungenen einheiten
					counterJumpedIn--;
					// alle einheiten sind reingesprungen
					if (counterJumpedIn <= 0)
					{
						// nun können wir kämpfen
						self.fighter.start();
					}
				}
			});
		});
	};

	// normaler Start mit Fight Anzeige
	fnShowTextFight();

	return this;
};

/**
 * wenn der Kampf beendet ist
 *
 * @param {Ee.Units} unitsWinner
 * @returns {Ee}
 */
Ee.prototype.finish = function(unitsWinner)
{
	var self = this;

	Ee.log('Party ' + unitsWinner.id + ' has won!');

	// zu ende oder weiter
	if (!Ee.Balancing.parties[unitsWinner.id] || !Ee.Balancing.parties[unitsWinner.id].attackInterface)
	{
		// Fight Loose animation und dann ist SCHLUSS
		new Ee.Animations.ShowText(
		{
			image: Ee.Balancing.showText.looseFight,
			onComplete: function()
			{
				Ee.log('it is over.');
			}
		});

		return this;
	}

	Ee.log('starting elements');

	// Fight Win animation und dann fight gegen elements
	new Ee.Animations.ShowText(
	{
		image: Ee.Balancing.showText.winFight,
		onComplete: function()
		{
			// die Gewinner Party hinzufügen
			self.elementsFighter.add(unitsWinner);

			// die einheitenparty erzeugen
			var units = new Ee.Units.Elements(
			{
				id: unitsWinner.id + 1
			});

			// element party hinzufügen
			self.elementsFighter.add(units);

			// die Element Einheiten erzeugen
			units.fillUp();

			// start des Element Fights
			self.elementsFighter.start();
		}
	});

	return this;
};