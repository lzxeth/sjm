<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html" encoding="UTF-8" indent="no"/>
 <xsl:template match="collection">
      <xsl:apply-templates select="cd"/>
 </xsl:template>
 <xsl:template match="cd">
  <h1><xsl:value-of select="title"/></h1>
  <h2>by <xsl:value-of select="artist"/> - <xsl:value-of select="year"/></h2>
  <hr />
 </xsl:template>
</xsl:stylesheet>