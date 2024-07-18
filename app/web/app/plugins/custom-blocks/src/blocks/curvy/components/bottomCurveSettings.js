import {
	HorizontalRule,
	RangeControl,
	ToggleControl,
} from "@wordpress/components";
import { ColorPalette } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import metadata from "../block.json";

export const BottomCurveSettings = (props) => {
	return (
		<>
			<HorizontalRule />
			<RangeControl
				min={100}
				max={300}
				value={props.attributes.bottomWidth || 100}
				onChange={(newValue) => {
					props.setAttributes({
						bottomWidth: parseInt(newValue),
					});
				}}
				label={__("Width", metadata.textdomain)}
			/>
			<RangeControl
				min={0}
				max={200}
				value={props.attributes.bottomHeight}
				onChange={(newValue) => {
					props.setAttributes({
						bottomHeight: parseInt(newValue),
					});
				}}
				label={__("Height", metadata.textdomain)}
			/>
			<HorizontalRule />
			<div style={{ display: "flex" }}>
				<ToggleControl
					onChange={(isChecked) => {
						props.setAttributes({ bottomFlipHorizontal: isChecked });
					}}
					// Sets the initial state of the toggle control
					checked={props.attributes.bottomFlipHorizontal}
				/>
				<span>{__("Flip horizontally", metadata.textdomain)}</span>
			</div>
			<div style={{ display: "flex" }}>
				<ToggleControl
					onChange={(isChecked) => {
						props.setAttributes({ bottomFlipVertical: isChecked });
					}}
					// Sets the initial state of the toggle control
					checked={props.attributes.bottomFlipVertical}
				/>
				<span>{__("Flip vertically", metadata.textdomain)}</span>
			</div>
			<HorizontalRule />
			<label>{__("Curve colour", metadata.textdomain)}</label>
			{/* Import ColorPalette, add attribute in block.json, access that attribute via props in edit.js, and set that attribute via props.setAttribute */}
			<ColorPalette
				value={props.attributes.bottomColor}
				onChange={(newValue) => {
					props.setAttributes({ bottomColor: newValue });
				}}
			/>
		</>
	);
};
