/**
 * Unit Object
 *
 * @param {Object} options
 * @param {Ee.Units} parent
 * @returns {Ee.Unit}
 */
Ee.Unit = function(options, parent)
{
	if (!options || typeof options.type == 'undefined')
	{
		throw 'Missing type in options for unit';
	}

	Ee.Base.call(this, options, parent);

	this.create();

	this.element._unit = this;
	this.element.setStyles(
	{
		outline: '0px solid transparent',
		visibility: 'visible'
	});

	return this;
};

/**
 * liefert die Balancing Werte
 *
 * @var {Object}
 */
Ee.Unit.prototype.balancing = {};

/**
 * wurde die Einheit angeklickt welches den Click Bonus liefert?
 *
 * @var {Boolean}
 */
Ee.Unit.prototype.clicked = false;

/**
 * wurde die Einheit angeklickt welches den Click Bonus liefert?
 *
 * @var {HTMLElement}
 */
Ee.Unit.prototype.element = null;

/**
 * Gesundheit der Einheit
 *
 * @var {Number}
 */
Ee.Unit.prototype.health = 100;

/**
 * Trefferchance
 *
 * @var {Number}
 */
Ee.Unit.prototype.hitChance = 0.1;

/**
 * Id der Unit
 *
 * @var {Number}
 */
Ee.Unit.prototype.id = 0;

/**
 * Angriffswert
 *
 * @var {Number}
 */
Ee.Unit.prototype.offense = 0.5;

/**
 * Größe der Einheit
 *
 * @var {Object} {x: 0, y: 0}
 */
Ee.Unit.prototype.size = {};

/**
 * Geschwindigkeit in Pixel
 *
 * @var {Number}
 */
Ee.Unit.prototype.speed = 1;

/**
 * Type der Einheit
 *
 * @var {String}
 */
Ee.Unit.prototype.type = 'unit0';

/**
 * Unit Collection der Units
 *
 * @var {Ee.Units}
 */
Ee.Unit.prototype.units = null;

/**
 * Einheit die angegriffen wird
 *
 * @var {Unit}
 */
Ee.Unit.prototype.unitToAttack = {};

/**
 * Einheit die diese Einheit angreift
 *
 * @var {Unit}
 */
Ee.Unit.prototype.unitWichAttacks = {};

// Prototype
Ee.Unit.prototype = Object.create(Ee.Base.prototype,
{
	balancing:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return Ee.Balancing.units[this.type];
		}
	},

	clicked:
	{
		value: false,
		enumerable: false,
		configurable: false,
		writable: true
	},

	health:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (typeof this._health == 'undefined')
			{
				this._health = this.balancing.health;
			}

			return this._health;
		},
		set: function(value)
		{
			// Balancing holen und initialisieren
			if (typeof this._health == 'undefined')
			{
				this._health = this.balancing.health;
			}

			// einheit ist TOT
			if (value <= 0)
			{
				this.die();
			}

			// gesundheit setzen
			this._health = Math.min(Math.max(0, value), 100);

			// einheitenstatus visualisieren
			this.element.setStyles(
			{
				opacity: (this._health * 100 / this.balancing.health) / 100
			});
		}
	},

	hitChance:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			var hitChance = this.balancing.hitChance;
			if (this.clicked)
			{
				hitChance += this.balancing.clickBonus;
			}
			return hitChance;
		}
	},

	id:
	{
		value: 0,
		enumerable: false,
		configurable: false,
		writable: true
	},

	offense:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this.balancing.offense;
		}
	},

	size:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (!this._size)
			{
				this._size = this.element.getSize();
			}

			return this._size;
		}
	},

	speed:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this.balancing.speed;
		}
	},

	type:
	{
		value: 'unit0',
		enumerable: false,
		configurable: false,
		writable: true
	},

	units:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this.parent;
		}
	},

	unitToAttack:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (typeof this._unitToAttack == 'undefined')
			{
				return null;
			}

			return this._unitToAttack;
		},
		set: function(unitToAttack)
		{
			var self = this;

			// setzen
			this._unitToAttack = unitToAttack;

			// diese einheit nicht mehr angreifen
			if (this._unitToAttack === null)
			{
				// eventuelles lauf intervall löschen
				if (this._walkInterval)
				{
					clearInterval(this._walkInterval);
					this._walkInterval = null;
				}
				if (this._attackingInterval)
				{
					clearInterval(this._attackingInterval);
					this._attackingInterval = null;
				}
				
			}
			// neue einheit angreifen
			else
			{
				// zu der einheit hin laufen überwachen
				this._walkInterval = this.walk.periodical(Ee.Math.random(Ee.Balancing.fight.walkTimeInterval.min, Ee.Balancing.fight.walkTimeInterval.max), this);
				this._attackingInterval = this.attack.periodical(Ee.Math.random(Ee.Balancing.fight.attackTimeInterval.min, Ee.Balancing.fight.attackTimeInterval.max), this);

				Ee.log(this.type + ' ' + this.id + ' is attacking ' + this._unitToAttack.type);
			}
		}
	},

	unitWichAttacks:
	{
		value: null,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * greift eine Einheit an
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.prototype.attack = function()
{
	// Angreifer ist tot oder keine anzugreifende Einheit oder anzugreifende Einheit ist tot
	if (this.health == 0)
	{
		return this;
	}

	// keine anzugreifende Einheit oder anzugreifende Einheit ist tot
	if (this.unitToAttack == null || this.unitToAttack.health == 0)
	{
		this.units.fighter.findCombatant(this);
		return this;
	}

	// prüfen ob in reichweite
	if (this.distanceToUnitToAttack() > Ee.Balancing.fight.minAttackRange)
	{
		return this;
	}

	// Hit auf die andere Einheit ausführen
	var hitChance = this.hitChance;
	this.clicked = false;

	// soll getroffen werden
	if (Ee.Math.random(0, 100) <= hitChance)
	{
		new Ee.Animations.ShowHit(
		{
			element: this.unitToAttack.element,
			color: this.units.color
		});
		this.unitToAttack.health -= this.offense;
	}

	return this;
};

/**
 * lässt die Einheit sterben
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.prototype.die = function()
{
	Ee.log(this.type + ' ' + this.id + ' is dead.');

	// einheit aus der Party entfernen
	this.units.remove(this);

	// einheit kann niemanden mehr angreifen
	this.unitToAttack = null;

	// element entfernen
	this.element.dispose();

	// eventuelles lauf intervall löschen
	if (this._walkInterval)
	{
		clearInterval(this._walkInterval);
		this._walkInterval = null;
	}
	if (this._attackingInterval)
	{
		clearInterval(this._attackingInterval);
		this._attackingInterval = null;
	}

	// mitteilen das diese TOT ist
	this.fireEvent('die', this);

	return this;
};

/**
 * erzeugt das Element
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.prototype.create = function()
{
	var self = this;

	// element icon erzeugen
	this.element = new Element('img',
	{
		src: this.balancing.picture,
		styles:
		{
			position: 'absolute',
			opacity: 0.1,
			zIndex: Ee.ZINDEX_BASE
		}
	});

	// element bereits in den DOM verschieben, es ist aber noch nicht sichtbar
	window.document.body.insert(
	{
		bottom: this.element
	});

	// click binden damit getrackt wird, ob die unit angeklickt wurde und der Bonus ausgeführt werden muss
	this.element.addEvent('click', function()
	{
		self.clicked = true;
	});

	return this;
};

/**
 * liefert die Position der Einheit zur Element Mitte
 *
 * @returns {Object} {x: 0, y: 0}
 */
Ee.Unit.prototype.getPosition = function()
{
	var position = this.element.getPosition();

	position.x += Math.floor(this.size.x / 2);
	position.y += Math.floor(this.size.y / 2);

	return position;
};

/**
 * berechnet die Distance der anzugreifenden Unit zu einer angegebnen Unit unter beachtung der aktuellen
 * Position und der Dimension der Units
 *
 * @returns {Number}
 */
Ee.Unit.prototype.distanceToUnitToAttack = function()
{
	// keine anzugreifende Einheit oder anzugreifende Einheit ist tot
	if (this.unitToAttack == null || this.unitToAttack.health == 0)
	{
		return 0;
	}

	var positionThisUnit = this.getPosition();
	var positionOtherUnit = this.unitToAttack.getPosition();

	var sign = Ee.Math.sign(positionOtherUnit.x, positionThisUnit.x);
	var dist = 0;

	// die einheiten sind auf der gleiche x koordinate. dann ist der abstand nur über y zu bestimmen
	if (positionThisUnit.x == positionOtherUnit.x)
	{
		sign = Ee.Math.sign(positionOtherUnit.y, positionThisUnit.y);
		dist = Math.abs((positionThisUnit.y + sign * this.size.y / 2) - (positionOtherUnit.y + (-1) * sign * this.unitToAttack.size.y / 2));
	}
	// die einheiten sind auf unterschiedlichen x koordinaten, dann über die lineare funktion
	// zum rand der einheiten bestimmen
	else
	{
		var n = positionOtherUnit.x - (positionThisUnit.x * positionOtherUnit.y / positionThisUnit.y);
		var m = (positionOtherUnit.x - n) / positionOtherUnit.y;

		var thisUnitX = (positionThisUnit.x + sign * this.size.x / 2);
		var otherUnitX = (positionOtherUnit.x + (-1) * sign * this.unitToAttack.size.x / 2);

		if (!isFinite(m) || !isFinite(n) || isNaN(m) || isNaN(n))
		{
			return 0;
		}

		dist = Math.sqrt(Math.pow(thisUnitX - otherUnitX, 2) + Math.pow((m * thisUnitX + n) - (m * otherUnitX + n), 2));
	}

	// wenn die einheiten sich berühren bzw. wenn eine einheit im bereich der anderen einheit liegt dann muss die distanz negativ sein
	if (Ee.Math.rectsAreOverlapped(
	{
		x1: Math.floor(positionThisUnit.x - this.size.x / 2),
		y1: Math.floor(positionThisUnit.y - this.size.y / 2),
		x2: Math.floor(positionThisUnit.x + this.size.x / 2),
		y2: Math.floor(positionThisUnit.y + this.size.y / 2)
	},
	{
		x1: Math.floor(positionOtherUnit.x - this.unitToAttack.size.x / 2),
		y1: Math.floor(positionOtherUnit.y - this.unitToAttack.size.y / 2),
		x2: Math.floor(positionOtherUnit.x + this.unitToAttack.size.x / 2),
		y2: Math.floor(positionOtherUnit.y + this.unitToAttack.size.y / 2)
	}))
	{
		dist *= -1;
	}

	return Math.floor(dist);
};

/**
 * setzt die Position der Einheit zur Element Mitte
 *
 * @params {Object} position {x: 0, y: 0}
 * @returns {Ee.Unit}
 */
Ee.Unit.prototype.setPosition = function(position)
{
	this.element.setStyles(
	{
		left: position.x - Math.floor(this.size.x / 2),
		top: position.y - Math.floor(this.size.y / 2)
	});

	return this;
};

/**
 * lässt die einheit ein wenig laufen
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.prototype.walk = function()
{
	// keine anzugreifende Einheit oder anzugreifende Einheit ist tot
	if (this.unitToAttack == null || this.unitToAttack.health == 0)
	{
		return this;
	}

	// prüfen ob nicht in reichweite
	if (this.distanceToUnitToAttack() <= Ee.Balancing.fight.minAttackRange)
	{
		return this;
	}

	// diese Einheit zu der anderen Einheit hinlaufen lassen
	var positionThisUnit = this.getPosition();
	var positionOtherUnit = this.unitToAttack.getPosition();

	var speed = this.speed * Ee.Math.sign(positionOtherUnit.x, positionThisUnit.x);
	var m = (positionOtherUnit.y - positionThisUnit.y) / (positionOtherUnit.x - positionThisUnit.x);
	var n = positionOtherUnit.y - m * positionOtherUnit.x;

	var moveByY = positionThisUnit.x - this.size.x / 2 <= positionOtherUnit.x && positionOtherUnit.x <= positionThisUnit.x + this.size.x / 2;

	// positionen entsprechend setzen
	if (!moveByY && isFinite(m) && isFinite(n) && !isNaN(m) && !isNaN(n))
	{
		this.setPosition(
		{
			x: positionThisUnit.x + speed,
			y: m * (positionThisUnit.x + speed) + n
		});
	}
	else
	{
		speed = this.speed * Ee.Math.sign(positionOtherUnit.y, positionThisUnit.y);
		this.setPosition(
		{
			x: positionThisUnit.x,
			y: positionThisUnit.y + speed
		});
	}

	return this;
};