tinyMCE.init({
	language:"fr_FR",
	mode:"textareas",
	theme:"silver",
	menubar:false,
	plugins:"lists,link",
	toolbar:"undo redo| formatselect|bold italic underline|bullist numlist | link",
	block_formats: 'Paragraphe=p; Sous-titre=h3; Petit sous-titre=h4',
	visibility: "visible",
	forced_root_block : false,
	force_br_newlines : true,
	force_p_newlines : false,
	entity_encoding : "raw"
});
