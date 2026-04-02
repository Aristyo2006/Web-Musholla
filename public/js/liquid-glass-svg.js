/**
 * SVG Displacement Filter Generator for Liquid Glass Effect
 * Refactored with Circular Mask to prevent Square Boundary artifacts during scaling/hover.
 */

const LiquidGlassSVG = (() => {
    const getDisplacementMap = ({ height, width, radius, depth }) => {
        const svgContent = `<svg height="${height}" width="${width}" viewBox="0 0 ${width} ${height}" xmlns="http://www.w3.org/2000/svg">
            <style>.mix { mix-blend-mode: screen; }</style>
            <defs>
                <linearGradient id="Y" x1="0" x2="0" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="#0F0" />
                    <stop offset="100%" stop-color="#000" />
                </linearGradient>
                <linearGradient id="X" x1="0%" x2="100%" y1="0" y2="0">
                    <stop offset="0%" stop-color="#F00" />
                    <stop offset="100%" stop-color="#000" />
                </linearGradient>
                <clipPath id="mask-circle">
                    <circle cx="${width / 2}" cy="${height / 2}" r="${radius}" />
                </clipPath>
            </defs>
            
            <!-- Default Neutral Grey Background: 128,128,128 (No Displacement) -->
            <rect x="0" y="0" height="${height}" width="${width}" fill="#808080" />
            
            <!-- Interactive Liquid Layer clipped to the Button Circle -->
            <g clip-path="url(#mask-circle)" filter="blur(2px)">
                <!-- Base Max Displacement (B=128 is neutral, R=0 G=0 is max negative) -->
                <rect x="0" y="0" height="${height}" width="${width}" fill="#000080" />
                <rect x="0" y="0" height="${height}" width="${width}" fill="url(#Y)" class="mix" />
                <rect x="0" y="0" height="${height}" width="${width}" fill="url(#X)" class="mix" />
                
                <!-- Central Neutral Circle (The 'lens' effect) -->
                <circle cx="${width / 2}" cy="${height / 2}" r="${radius - depth}" fill="#808080" filter="blur(${depth}px)" />
            </g>
        </svg>`;
        return "data:image/svg+xml;utf8," + encodeURIComponent(svgContent.replace(/\s+/g, ' '));
    };

    const getDisplacementFilter = ({ height, width, radius, depth, strength = 10, chromaticAberration = 2 }) => {
        const mapUrl = getDisplacementMap({ height, width, radius, depth });
        const svgFilter = `<svg height="${height}" width="${width}" viewBox="0 0 ${width} ${height}" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <filter id="displace" color-interpolation-filters="sRGB">
                    <feImage x="0" y="0" height="${height}" width="${width}" href="${mapUrl}" result="displacementMap" />
                    
                    <feDisplacementMap in="SourceGraphic" in2="displacementMap" scale="${strength + chromaticAberration * 2}" xChannelSelector="R" yChannelSelector="G" result="displacedRaw" />
                    <feColorMatrix in="displacedRaw" type="matrix" values="1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 1 0" result="displacedR" />
                    
                    <feDisplacementMap in="SourceGraphic" in2="displacementMap" scale="${strength + chromaticAberration}" xChannelSelector="R" yChannelSelector="G" result="displacedRaw2" />
                    <feColorMatrix in="displacedRaw2" type="matrix" values="0 0 0 0 0 0 1 0 0 0 0 0 0 0 0 0 0 0 1 0" result="displacedG" />
                    
                    <feDisplacementMap in="SourceGraphic" in2="displacementMap" scale="${strength}" xChannelSelector="R" yChannelSelector="G" result="displacedRaw3" />
                    <feColorMatrix in="displacedRaw3" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 1 0 0 0 0 0 1 0" result="displacedB" />
                    
                    <feBlend in="displacedR" in2="displacedG" mode="screen" result="rg" />
                    <feBlend in="rg"  in2="displacedB" mode="screen" />
                </filter>
            </defs>
        </svg>`;
        return "data:image/svg+xml;utf8," + encodeURIComponent(svgFilter.replace(/\s+/g, ' ')) + "#displace";
    };

    return { getDisplacementFilter };
})();

window.LiquidGlassSVG = LiquidGlassSVG;
