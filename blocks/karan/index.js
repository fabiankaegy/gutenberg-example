// Import Block Dependencys 
import './style.scss';
import './editor.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;

/**
 * Register block
 */
export default registerBlockType( 'jsforwpblocks/karan', {
	title: 'Karan',
	description: 'Karan Wood Desk Cat Whatever...',
	category: 'common',
	icon: 'visibility',
	keywords: [
		'Dog',
	],
	attributes: {
		ourText: {
			type: 'array',
			source: 'children',
			selector: 'p',
		},
	},
	edit: props => {
		const { attributes: { ourText }, setAttributes, className } = props;
		return (
			<RichText
                tagName="p"
                className={ className }
                value={ ourText }
                onChange={ ( newValue ) => setAttributes( { ourText: newValue } ) }
            />
		);
	},
	save: props => {
		const { attributes: { ourText } } = props;
		return (
			<p>{ ourText }</p>
		);
	}
} );