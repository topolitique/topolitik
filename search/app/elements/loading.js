import React from 'react';

const Logo = ({
  className,
  color,
  size = '64px',
  height = 'auto'
}) => {
  return (
    <svg className={className} style={{width: size, height: size}} viewBox="0 0 182 182" version="1.1" xmlns="http://www.w3.org/2000/svg" >
        <path 
          fill={color} style={{ fill: color | 'white', fillRule: 'non-zero'}}
          d="M36.724,96.378c2.838,27.297 25.942,48.609 53.985,48.609l0,28.706c-43.895,0 -79.876,-34.155 -82.793,-77.315l28.808,0Zm53.985,-88.654c45.8,0.001 82.984,37.184 82.984,82.985c0,1.905 -0.064,3.796 -0.191,5.669l-28.809,0c0.194,-1.864 0.294,-3.755 0.294,-5.669c0,-29.957 -24.321,-54.278 -54.278,-54.278l0,-28.707Z" />
	  </svg>	
  );
}

export default Logo;