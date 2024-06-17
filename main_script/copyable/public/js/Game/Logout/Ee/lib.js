Ee.Object = {};
Ee.Math = {};
Ee.Elements = {};

/**
 * Prüft ob eine Property an dem Objekt oder der Prototype Chain enthalten ist
 *
 * @param {Object} object
 * @param {String} propertyName
 * @returns {Boolean}
 */
Ee.Object.hasProperty = function(object, propertyName)
{
	if (!object)
	{
		return false;
	}

	if (typeof object[propertyName] == 'undefined')
	{
		if (object.__proto__ === null)
		{
			return false;
		}

		return Ee.Object.hasProperty(object.__proto__, propertyName);
	}

	return true;
};

/**
 * extends an object by another object an return the extended object.
 *
 * @param {Object} destObject
 * @param {Object} srcObject
 * @returns {Object}
 */
Ee.Object.extend = function(destObject, srcObject)
{
	var resultObject = destObject;

	for (var property in srcObject)
	{
		try
		{
			// Property in destination object set; update its value.
			switch (Ee.Object.typeOf(srcObject[property]))
			{
				case 'array':
					resultObject[property] = srcObject[property];
					break;

				case 'object':
					// ein einfaches Object, dann kopieren
					if (Ee.Object.isSimple(srcObject[property]))
					{
						resultObject[property] = Ee.Object.extend(resultObject[property] || {}, srcObject[property]);
					}
					// object referenzieren
					else
					{
						resultObject[property] = srcObject[property];
					}
					break;

				default:
					resultObject[property] = srcObject[property];
					break;
			}
		}
		catch (e)
		{
			// Property in destination object not set; create it and set its value.
			resultObject[property] = srcObject[property];
		}
	}

	return resultObject;
};

/**
 * liefert den typ eines Objektes
 *
 * @param {Object} object
 * @returns {String}
 */
Ee.Object.typeOf = function(object)
{
	if (object.__proto__ && object.__proto__.constructor && object.__proto__.constructor.name)
	{
		return object.__proto__.constructor.name.toLowerCase();
	}

	return (typeof object);
};

/**
 * prüft, ob dies ein einfaches Objekt ist oder eine Instanz von irgendwas
 *
 * @param {Object} object
 * @returns {Boolean}
 */
Ee.Object.isSimple = function(object)
{
	return (object.__proto__ && object.__proto__.__proto__ === null);
};

/**
 * Random min max
 *
 * @param {Number} min
 * @param {Number} max
 * @returns {Number}
 */
Ee.Math.random = function(min, max)
{
	return Math.floor(min + Math.random() * (max - min + 1));
};

/**
 * sign
 *
 * @param {Number} a
 * @param {Number} b
 * @return {Number}
 */
Ee.Math.sign = function(a, b)
{
	return (a < b ? - 1 : (a > b ? 1 : 0));
};

/**
 * überprüft ob die angegeben Rechtecke sich überlappen
 *
 * @params {Object} rectA {left: 0, top: 0, right: 0, bottom: 0}
 * @params {Object} rectB {left: 0, top: 0, right: 0, bottom: 0}
 * @returns {Boolean}
 */
Ee.Math.rectsAreOverlapped = function(rectA, rectB)
{
	return (rectA.x1 < rectB.x2 && rectA.x2 > rectB.x1 && rectA.y1 < rectB.y2 && rectA.y2 > rectB.y1);
};

/**
 * findet alle Element, welche keine Kind Elemente habe
 *
 * @return {Array}
 */
Ee.Elements.getElementsWithoutChilds = function(limit)
{
	return document.body.select('*').inject([], function(acc, element)
	{
		if (acc.length == limit)
		{
			return acc;
		}

		// hat childs
		if (element.children.length != 0)
		{
			return acc;
		}

		if (Ee.Math.random(0, 1) && element.parentNode && element.parentNode != document.body)
		{
			acc.push(element.parentNode);
		}
		else
		{
			acc.push(element);
		}
		return acc;
	});
};

/**
 * shuffle
 * @returns {Array}
 */
Array.prototype.shuffle = function()
{
	var tmp, rand;
	var result = this;

	for (var i = 0; i < result.length; i++)
	{
		rand = Math.floor(Math.random() * result.length);
		tmp = result[i];
		result[i] = result[rand];
		result[rand] = tmp;
	}

	return result;
};