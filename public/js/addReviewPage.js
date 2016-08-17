

$("#hallNameSelect").select2({
    tags: true,
    placeholder: "Select Halls",
    allowClear: true,
    data: $("#hallNameSelect").data("hall-names")
})

$("#uniNameSelect").select2({
    tags: true,
    placeholder: "Select a University",
    allowClear: true,
    data: $("#uniNameSelect").data("hall-names")
})
