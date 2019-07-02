
function paginate(page, tpages, adjacents, limit, mainFucnction) {
    var out = '';

    page = page + 1;
    // first label
	if(page > (adjacents+1)) {
		out+= "<li><a href='javascript:void(0);' onclick='"+mainFucnction+"(1,"+limit+")'>1</a></li>";
	}
    //intervalos
    if(page > ( tpages-adjacents - 1)) {
		out+= "<li><a>...</a></li>";
	}

    var pmin = (page > adjacents) ? (page - adjacents) : 1;
    var pmax = (page < (tpages - adjacents)) ? (page + adjacents) : tpages;

    for (let i = pmin; i <= pmax; i++) {
        if (i == page) {
            out += "<li class='active'><a>" + i + "</a></li>";
        } else if(i == 1) {
            out += "<li><a href='javascript:void(0);' onclick='"+mainFucnction+"(1,"+limit+")'>" + i + "</a></li>";
        } else {
            out += "<li><a href='javascript:void(0);' onclick='"+mainFucnction+"(" + i + ", "+limit+")'>" + i + "</a></li>";
        }
    }

    // interval

    if (page < (tpages - adjacents - 1)) {
        out += "<li><a>...</a></li>";
    }

    //última

    if(page < (tpages-adjacents)) {
		out += "<li><a href='javascript:void(0);' onclick='"+mainFucnction+"(" + tpages + ", "+limit+")'>" +tpages + "</a></li>";
	}

    return out;

}