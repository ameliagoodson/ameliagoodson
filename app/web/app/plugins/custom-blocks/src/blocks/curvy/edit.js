/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	useBlockProps,
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
	PanelBody,
	ToggleControl,
	HorizontalRule,
	RangeControl,
} from "@wordpress/components";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import "./editor.scss";

/**
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

import metadata from "./block.json";
import { Curve } from "./components/curve";

// Attributes from block.json are passed automatically to Edit Component. It is typically called props.
export default function Edit(props) {
	const { className, ...blockProps } = useBlockProps();
	return (
		<>
			<section className={`${className} alignfull`} {...blockProps}>
				{/* If the enableTopCurve attribute is true, the Curve component is rendered */}
				{props.attributes.enableTopCurve && (
					// Passes width and height props to the Curve component
					// Set width and height props to the value of the topWidth and topHeight attributes
					<Curve
						width={props.attributes.topWidth}
						height={props.attributes.topHeight}
						flipHorizontal={props.attributes.flipHorizontal}
						flipVertical={props.attributes.flipVertical}
					/>
				)}
			</section>
			<InspectorControls>
				<PanelBody title={__("Top Curve", metadata.textdomain)}>
					<div style={{ display: "flex" }}>
						{/* setAttributes is a method of each prop. You need to pass in a new value for your attribute */}
						<ToggleControl
							onChange={(isChecked) => {
								props.setAttributes({ enableTopCurve: isChecked });
							}}
							// Sets the initial state of the attribute (topcurve)
							checked={props.attributes.enableTopCurve}
						/>
						<span>{__("Enable top curve", metadata.textdomain)}</span>
					</div>
					{props.attributes.enableTopCurve && (
						<>
							<HorizontalRule />
							<RangeControl
								min={100}
								max={300}
								value={props.attributes.topWidth || 100}
								onChange={(newValue) => {
									props.setAttributes({
										topWidth: parseInt(newValue),
									});
								}}
								label={__("Width", metadata.textdomain)}
							/>
							<RangeControl
								min={0}
								max={200}
								value={props.attributes.topHeight}
								onChange={(newValue) => {
									props.setAttributes({
										topHeight: parseInt(newValue),
									});
								}}
								label={__("Height", metadata.textdomain)}
							/>
							<HorizontalRule />
							<div style={{ display: "flex" }}>
								<ToggleControl
									onChange={(isChecked) => {
										props.setAttributes({ flipHorizontal: isChecked });
									}}
									// Sets the initial state of the toggle control
									checked={props.attributes.flipHorizontal}
								/>
								<span>{__("Flip horizontally", metadata.textdomain)}</span>
							</div>
							<div style={{ display: "flex" }}>
								<ToggleControl
									onChange={(isChecked) => {
										props.setAttributes({ flipVertical: isChecked });
									}}
									// Sets the initial state of the toggle control
									checked={props.attributes.flipVertical}
								/>
								<span>{__("Flip vertically", metadata.textdomain)}</span>
							</div>
							<HorizontalRule />
							<label>{__("Curve colour", metadata.textdomain)}</label>

							<ColorPalette />
						</>
					)}
				</PanelBody>
			</InspectorControls>
		</>
	);
}
