/** @var allOptions - Get all options from html page  */
const allOptions = document.getElementsByTagName('option')

/** @var sectors - Store sectors in array */
const sectors = []

/** @var lastParents - Store last known parent with position as index */
const lastParents = []

/** @var jump - Define indent size */
const jump = 4

for (let i = 0; i < allOptions.length; i++) {
    /** @vars optionID - Get id value, optionName - simple name value, position - indent size */
    const optionID = parseInt(allOptions[i].value)
    const optionName = allOptions[i].innerHTML.replaceAll('&nbsp;', '')
    const position = (allOptions[i].innerHTML.match(/&nbsp;/g) || []).length

    const sector = {
        id: optionID,
        name: optionName,
        parent: null,
    }

    /** If position is 0 we are dealing with root sector - therefore no parents */
    if(position === 0) {
        sectors.push(sector)
        lastParents[0] = sector
        continue
    }

    /**
     * Store last known parent to array by position
     *
     * for example: When we are at "Beverages" section then lastParents array
     * would look like this:
     *
     * lastParents = [
     *  0 => Manufacturing
     *  4 => Food and Beverage
     *  8 => Beverages
     * ]
     */
    lastParents[position] = sector

    /**
     * Parent is always current position - jump
     *
     * for example for "Beverages" section
     *
     * position would be 8
     * jump is always 4
     * parents position will be then 4, which last known parent for position 4 is
     * "Food and Beverage"
     */
    sector.parent = lastParents[position - jump]

    sectors.push(sector)
}

console.log(JSON.stringify(sectors))
