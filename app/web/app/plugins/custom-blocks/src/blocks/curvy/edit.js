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
	InnerBlocks,
} from "@wordpress/block-editor";
import { PanelBody, ToggleControl } from "@wordpress/components";

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
import { TopCurveSettings } from "./components/topCurveSettings";
import { BottomCurveSettings } from "./components/bottomCurveSettings";

// Attributes from block.json are passed automatically to Edit Component. It is typically called props.
export default function Edit(props) {
	const { className } = useBlockProps();
	const blockProps = useBlockProps({
		className: props.attributes.align ? `align${props.attributes.align}` : "",
	});
	return (
		<>
			<section className={{ className }} {...blockProps}>
				{/* If the enableTopCurve attribute is true, the Curve component is rendered */}
				{props.attributes.enableTopCurve && (
					// Passes width and height props to the Curve component
					// Set width and height props to the value of the topWidth and topHeight attributes
					<Curve
						width={props.attributes.topWidth}
						height={props.attributes.topHeight}
						flipHorizontal={props.attributes.topFlipHorizontal}
						flipVertical={props.attributes.topFlipVertical}
						color={props.attributes.topColor}
					/>
				)}
				<InnerBlocks />
				{props.attributes.enableBottomCurve && (
					// Passes props to the Curve component
					<Curve
						isBottom
						width={props.attributes.bottomWidth}
						height={props.attributes.bottomHeight}
						flipHorizontal={props.attributes.bottomFlipHorizontal}
						flipVertical={props.attributes.bottomFlipVertical}
						color={props.attributes.bottomColor}
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
							{/* Pass props down to TopCurveSettings component */}
							<TopCurveSettings
								attributes={props.attributes}
								setAttributes={props.setAttributes}
							/>
						</>
					)}
				</PanelBody>
				<PanelBody title={__("Bottom Curve", metadata.textdomain)}>
					<div style={{ display: "flex" }}>
						{/* setAttributes is a method of each prop. You need to pass in a new value for your attribute */}
						<ToggleControl
							onChange={(isChecked) => {
								props.setAttributes({ enableBottomCurve: isChecked });
							}}
							// Sets the initial state of the attribute (topcurve)
							checked={props.attributes.enableBottomCurve}
						/>
						<span>{__("Enable bottom curve", metadata.textdomain)}</span>
					</div>
					{props.attributes.enableBottomCurve && (
						<>
							{/* Pass props down to BottomCurveSettings component */}
							<BottomCurveSettings
								attributes={props.attributes}
								setAttributes={props.setAttributes}
							/>
						</>
					)}
				</PanelBody>
			</InspectorControls>
		</>
	);
}
